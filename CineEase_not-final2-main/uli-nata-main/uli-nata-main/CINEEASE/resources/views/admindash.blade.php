<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('admin.manage-users') }}" class="text-sm text-gray-700 underline">Manage Users</a>
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
                        <h1>Movie List</h1>

                        <table class="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 20%; text-align: left;">Title</th>
                                    <th style="width: 20%; text-align: left;">Poster</th>
                                    <th style="width: 30%; text-align: left;">Description</th>
                                    <th style="width: 10%; text-align: left;">Showing Date</th>
                                    <th style="width: 10%; text-align: left;">Seats Available</th>
                                    <th style="width: 10%; text-align: right;">Ticket Price</th>
                                    <th style="width: 10%; text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movies as $movie)
                                <tr id="movie_{{ $movie->id }}">
                                    <td>{{ $movie->title }}</td>
                                    <td><img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="w-20 h-20"></td>
                                    <td>{{ $movie->description }}</td>
                                    <td>{{ $movie->date_showing }}</td>
                                    <td>{{ $movie->seats_available }}</td>
                                    <td style="text-align: right;">₱{{ number_format($movie->amount, 2) }}</td>
                                    <td style="text-align: right;">
                                        <a href="{{ route('admin.movies.edit', $movie->id) }}" class="text-sm text-gray-700 underline">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
