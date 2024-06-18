<!-- resources/views/admin/movies/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Movie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
                            <input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $movie->title }}" required autofocus>
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                            <textarea id="description" class="block mt-1 w-full" name="description" required>{{ $movie->description }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="date_showing" class="block font-medium text-sm text-gray-700">Showing Date</label>
                            <input id="date_showing" class="block mt-1 w-full" type="date" name="date_showing" value="{{ $movie->date_showing }}" required>
                        </div>

                        <div class="mt-4">
                            <label for="amount" class="block font-medium text-sm text-gray-700">Ticket Price</label>
                            <input id="amount" class="block mt-1 w-full" type="number" step="0.01" name="amount" value="{{ $movie->amount }}" required>
                        </div>

                        <div class="mt-4">
                            <label for="seats_available" class="block font-medium text-sm text-gray-700">Seats Available</label>
                            <input id="seats_available" class="block mt-1 w-full" type="number" name="seats_available" value="{{ $movie->seats_available }}" required>
                        </div>

                        <div class="mt-4">
                            <label for="poster" class="block font-medium text-sm text-gray-700">Poster</label>
                            <input id="poster" class="block mt-1 w-full" type="file" name="poster">
                            <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="mt-2" style="width: 100px; height: auto;">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Update Movie') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
