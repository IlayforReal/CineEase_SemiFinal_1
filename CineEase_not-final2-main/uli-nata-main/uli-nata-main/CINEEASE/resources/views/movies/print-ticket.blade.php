<x-app-layout>
    <x-slot name="header">
    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
    </x-slot>

    <div class="main-content">
    <div class="movies-container2">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="ticket-container bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="ticket-header bg-orange-500 text-white p-6 text-center">
                    <h1 class="text-2xl font-bold mt-2">Movie Ticket</h1>
                </div>
                <div class="ticket-body p-6 sm:px-20 bg-white border-b border-gray-200 flex justify-center items-center">
                    <div class="poster-container mr-8">
                        <img src="{{ asset('storage/' . $booking->poster) }}" alt="Movie Poster" class="poster-image">
                    </div>
                    <div class="ticket-details text-left">
                        <h2 class="text-2xl font-semibold mb-4">{{ $booking->movie_title }}</h2>
                        <p><strong>Booking ID:</strong> {{ $booking->id }}</p>
                        <p><strong>Movie ID:</strong> {{ $booking->movie_id }}</p>
                        <p><strong>User ID:</strong> {{ $booking->user_id }}</p>
                        <p><strong>Username:</strong> {{ $booking->user->name }}</p>
                        <p><strong>Email:</strong> {{ $booking->user->email }}</p>
                        <p><strong>Seat Arrangement:</strong> {{ $booking->seatArrangement }}</p>
                        <p><strong>Number of Seats:</strong> {{ $booking->seats_booked }}</p>
                        <p><strong>Total Amount:</strong> {{ number_format($booking->total_amount, 2) }} pesos</p>
                        <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}</p>
                    </div>
                </div>
                <div class="ticket-footer p-4 bg-gray-100 flex justify-between">
                    <p class="text-lg">Date and Time: {{ $booking->created_at->format('Y-m-d H:i:s') }}</p>
                    <p class="text-lg">CineEase</p>
                </div>
            </div>
        </div>
        <!-- Buttons outside the ticket container -->
    <div class="flex justify-between mt-8 mx-8">
        <button onclick="window.print()" class="save-ticket-button bg-orange-500 text-white py-2 px-4 rounded hover:bg-orange-600">Save Ticket</button>
    </div>
    </div>
    </div>

    <!-- Link to external CSS file -->
    <link href="{{ asset('css/ticket.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/book.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userdash.css') }}">

</x-app-layout>
