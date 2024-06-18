<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function showBookingPage($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.book', compact('movie'));
    }
    public function showConfirmBookingPage()
{
    // Retrieve any necessary data if needed
    $booking = session('booking');

    // Render the view without any additional redirection logic
    return view('movies.confirm', compact('booking'));
}


    public function reserveSeat(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'seatArrangement' => 'required|array',
            'seatArrangement.*' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $movie = Movie::findOrFail($request->movie_id);
        $totalAmount = $request->quantity * $movie->amount; // Assuming movie has an amount field

        session([
            'booking' => [
                'user_id' => auth()->id(),
                'movie_id' => $request->movie_id,
                'movie_title' => $movie->title,
                'poster' => $movie->poster,
                'amount' => $movie->amount,
                'seatArrangement' => $request->seatArrangement,
                'quantity' => $request->quantity,
                'total_amount' => $totalAmount,
                'date_showing' => $movie->date_showing,
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

    if (!$booking) {
        return redirect()->route('dashboard')->with('error', 'No booking data found.');
    }

    $request->validate([
        'payment_method' => 'required|string|in:credit_card,debit_card,paypal',
    ]);

    DB::beginTransaction();

    try {
        $createdBooking = Booking::create([
            'user_id' => auth()->id(),
            'movie_id' => $booking['movie_id'],
            'movie_title' => $booking['movie_title'],
            'poster' => $booking['poster'],
            'amount' => $booking['amount'],
            'seatArrangement' => json_encode($booking['seatArrangement']),
            'seats_booked' => $booking['quantity'],
            'total_amount' => $booking['total_amount'],
            'payment_method' => $request->payment_method,
        ]);

        session()->forget('booking');

        DB::commit();

        return redirect()->route('movies.print.ticket', ['booking_id' => $createdBooking->id])->with('success', 'Booking confirmed!');
    } catch (\Exception $e) {
        DB::rollBack();

        \Log::error('Error storing booking: ' . $e->getMessage());

        return redirect()->route('dashboard')->with('error', 'Failed to store booking.');
    }
}
    public function printTicket($booking_id)
    {
        $booking = Booking::with('user')->findOrFail($booking_id);

        return view('movies.print-ticket', compact('booking'));
    }
}
