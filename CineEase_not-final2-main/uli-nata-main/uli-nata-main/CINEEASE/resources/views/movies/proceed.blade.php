<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
        <a href="{{ route('movies.book', ['id' => 1]) }}" class="nav-link">Booking Page</a>
        <span class="nav-link">Confirm Booking Page</span>
        <link rel="stylesheet" href="{{ asset('css/userdash.css') }}">
        <link rel="stylesheet" href="{{ asset('css/book.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    </x-slot>

    <div class="main-content">
        <div class="movies-container2">
            <h2 class="section-title">Confirm Your Bookings Here</h2>
            <div class="movie-item2">
                <img src="{{ asset('storage/' . $booking['poster']) }}" alt="Movie Poster" class="poster">
                <div class="details2">
                    <h3 class="title">{{ $booking['movie_title'] }}</h3>
                    <p class="amount">Price: {{ $booking['amount'] }}</p>
                </div>
            </div>

            <div class="table-container-wrapper">
                <form action="{{ route('movies.confirm.booking') }}" method="POST">
                    @csrf
                    <input type="hidden" name="movie_id" value="{{ $booking['movie_id'] }}">

                    <div class="table-container">
                        <table>
                            <tr>
                                <td>Theater</td>
                                <td>Performance Art Theater</td>
                            </tr>
                            <tr>
                                <td>Seat Arrangement</td>
                                <td>{{ implode(', ', $booking['seatArrangement']) }}</td>
                            </tr>
                            <tr>
                                <td>No. of Seats</td>
                                <td>{{ $booking['quantity'] }}</td>
                            </tr>
                            <tr>
                                <td>Total Amount</td>
                                <td>{{ number_format($booking['total_amount'], 2) }} pesos</td>
                            </tr>
                            <tr>
                                <td>Payment Method</td>
                                <td>
                                    <div class="select-wrapper">
                                        <select id="payment_method" name="payment_method" style="width: 100%; height: 40px;">
                                            <option value="credit_card">Credit Card</option>
                                            <option value="debit_card">Debit Card</option>
                                            <option value="paypal">PayPal</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
            </div>
                    <div class="button-container">
                        <button type="submit" class="proceed-button">Confirm Booking</button>
                    </div>
                </form>
            </div>
        </div>
</x-app-layout>
