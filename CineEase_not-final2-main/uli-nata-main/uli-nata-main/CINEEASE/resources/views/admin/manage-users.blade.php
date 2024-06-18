<!-- resources/views/admin/manage-users.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Users') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                <a href="{{ route('admin.movies.create') }}" class="text-sm text-gray-700 underline">Add Movies</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as admin!") }}

                    <div>
                        <h1>User List</h1>

                        <table class="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 10%; text-align: left;">ID</th>
                                    <th style="width: 20%; text-align: left;">Name</th>
                                    <th style="width: 30%; text-align: left;">Email</th>
                                    <th style="width: 20%; text-align: left;">Movie Title</th>
                                    <th style="width: 15%; text-align: left;">Seats Reserved</th>
                                    <th style="width: 15%; text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @foreach ($user->bookings as $booking)
                                        <tr id="user_{{ $user->id }}">
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $booking->movie->title ?? 'N/A' }}</td>
                                            <td>
                                                {{ is_array($booking->seatArrangement) ? implode(', ', $booking->seatArrangement) : 'N/A' }}
                                            </td>
                                            <td style="text-align: right;">
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" style="padding: 5px 10px;">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
