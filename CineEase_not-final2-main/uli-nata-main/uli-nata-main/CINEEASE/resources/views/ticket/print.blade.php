<!-- resources/views/ticket/print.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ticket Print') }}
        </h2>
    </x-slot>

    <div>
        <p>Ticket ID: {{ $ticketId }}</p>
        <p>Account ID: {{ $user->id }}</p>
        <p>Reserved Seats: {{ $reservedSeats }}</p>
        <p>Username: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Total Amount: {{ $totalAmount }}</p>
    </div>
</x-app-layout>
