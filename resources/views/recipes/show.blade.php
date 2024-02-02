<!-- resources/views/recipes/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Recipe Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold">{{ $recipe->title }}</h3>
                    <p><strong>Content:</strong> {{ $recipe->content }}</p>
                    <p><strong>Rating:</strong> {{ $recipe->rating }}</p>
                    <img src="{{ asset('storage/images/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="mt-4">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
