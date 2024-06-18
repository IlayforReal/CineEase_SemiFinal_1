<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    
    public function showBookingPage($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.book', compact('movie'));
    }

    public function reserveSeat(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'seatArrangement' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $movie = Movie::findOrFail($request->movie_id);
        $totalAmount = $request->quantity * 150; // Assuming ticket price is 150 pesos

        session([
            'booking' => [
                'user_id' => auth()->id(),
                'movie_id' => $request->movie_id,
                'movie_title' => $movie->title,
                'poster' => $movie->poster,
                'seatArrangement' => $request->seatArrangement,
                'quantity' => $request->quantity,
                'total_amount' => $totalAmount,
            ]
        ]);

        return redirect()->route('movies.proceed');
    }

    public function proceed()
    {
        $booking = session('booking');

        if (!$booking) {
            return redirect()->route('dashboard')->with('error', 'No booking data found.');
        }

        return view('movies.proceed', compact('booking'));
    }

    public function confirmBooking(Request $request)
{
    $booking = session('booking');

    \Log::info('Booking data in confirmBooking:', ['booking' => $booking]);
    \Log::info('Request data in confirmBooking:', $request->all());

    if (!$booking) {
        return redirect()->route('dashboard')->with('error', 'No booking data found.');
    }

    $request->validate([
        'payment_method' => 'required|string|in:credit_card,debit_card,paypal',
    ]);

    DB::beginTransaction();

    try {
        Booking::create([
            'user_id' => auth()->id(),
            'movie_id' => $booking['movie_id'],
            'movie_title' => $booking['movie_title'],
            'poster' => $booking['poster'],
            'seatArrangement' => $booking['seatArrangement'],
            'seats_booked' => $booking['quantity'],
            'total_amount' => $booking['total_amount'],
            'payment_method' => $request->payment_method,
        ]);

        session()->forget('booking');

        DB::commit();

        return redirect()->route('movies.print.ticket')->with('success', 'Booking confirmed!');
    } catch (\Exception $e) {
        DB::rollBack();

        \Log::error('Error storing booking: ' . $e->getMessage());

        return redirect()->route('dashboard')->with('error', 'Failed to store booking.');
    }
}

    public function create()
    {
        return view('admin.movies.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'date_showing' => 'required|date',
            'amount' => 'required|numeric',
            'seats_available' => 'required|integer',
        ]);

        $posterPath = $request->file('poster')->store('posters', 'public');

        $movie = new Movie([
            'title' => $validatedData['title'],
            'poster' => $posterPath,
            'description' => $validatedData['description'],
            'date_showing' => $validatedData['date_showing'],
            'amount' => $validatedData['amount'],
            'seats_available' => $validatedData['seats_available'],
        ]);
        $movie->save();

        return redirect()->route('admin.dashboard')->with('success', 'Movie added successfully.');
    }

    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'date_showing' => 'required|date',
            'amount' => 'required|numeric',
            'seats_available' => 'required|integer',
        ]);

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $movie->poster = $posterPath;
        }

        $movie->title = $validatedData['title'];
        $movie->description = $validatedData['description'];
        $movie->date_showing = $validatedData['date_showing'];
        $movie->amount = $validatedData['amount'];
        $movie->seats_available = $validatedData['seats_available'];
        $movie->save();

        return redirect()->route('admin.dashboard')->with('success', 'Movie updated successfully.');
    }


    public function printTicket()
    {
        $booking = session('booking');

        if (!$booking) {
            return redirect()->route('dashboard')->with('error', 'No booking data found.');
        }

        return view('movies.print-ticket', compact('booking'));
    }
}
