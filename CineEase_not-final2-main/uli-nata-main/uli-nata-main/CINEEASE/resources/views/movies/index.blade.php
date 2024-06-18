<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movie List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-black border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Movies</h2>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($movies as $movie)
                            <div class="border rounded p-4">
                                <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="w-full h-48 object-cover mb-2">
                                <h3 class="text-lg font-bold">{{ $movie->title }}</h3>
                                <p class="text-sm">{{ $movie->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
