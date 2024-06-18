<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use App\Models\SeatReservation;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch movies from the database
        $movies = Movie::all();

        // Pass movies data to the view
        return view('dashboard', compact('movies'));
    }

    public function book()
    {
        return view('movies.book');
    }

    public function proceed()
    {
        return view('movies.proceed');
    }

    public function create()
    {
        return view('task.create');
    }

    public function reserveSeat(Request $request)
    {
        $validatedData = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'seatArrangement' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $user_id = Auth::id(); // Assuming you are using Laravel's authentication

        $reservation = SeatReservation::create([
            'user_id' => $user_id,
            'movie_id' => $validatedData['movie_id'],
            'seat_arrangement' => $validatedData['seatArrangement'],
            'quantity' => $validatedData['quantity'],
            'total_amount' => $validatedData['total_amount'],
        ]);

        // Store necessary data in session
        $request->session()->put('ticket_id', $reservation->id); // Assuming you generate a ticket ID after reservation
        $request->session()->put('reserved_seats', $validatedData['seatArrangement']); // Storing seat arrangement instead of quantity
        $request->session()->put('total_amount', $validatedData['total_amount']);

        // Redirect to the ticket print page
        return redirect()->route('ticket.print');
    }

    public function showBookingPage($id)
    {
        $movie = Movie::findOrFail($id); // Assuming Movie is the model for movies

        return view('movies.book', compact('movie'));
    }

    public function printTicket(Request $request)
    {
        $ticketId = $request->session()->get('ticket_id');
        $reservedSeats = $request->session()->get('reserved_seats');
        $totalAmount = $request->session()->get('total_amount');
        
        // Fetch user information if needed
        $user = Auth::user();

        // Pass data to the ticket print view
        return view('ticket.print', compact('ticketId', 'reservedSeats', 'totalAmount', 'user'));
    }
}
