<!-- resources/views/recipes/create.blade.php -->

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Recipe
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                </div>
                                <input id="dropzone-file" name="image" type="file" class="hidden" />
                            </label>
                        </div>


                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-600">Title</label>
                            <input type="text" name="title" id="title" class="mt-1 p-2 w-full border rounded-md">
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-600">Content</label>
                            <textarea name="content" id="content" class="mt-1 p-2 w-full border rounded-md"></textarea>
                        </div>


                        <div class="mb-4">
                            <label for="rating" class="block text-sm font-medium text-gray-600">Rating</label>
                            <input type="number" name="rating" id="rating" class="mt-1 p-2 w-full border rounded-md">
                        </div>

                <div>
                    <label for="category_id" class="block text-sm font-semibold text-gray-800 dark:text-gray-300">Category</label>
                    <select name="category_id" id="category_id" class="input-field">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="tags"
                        class="block text-sm font-semibold text-gray-800 dark:text-gray-300">tags</label>
                    <select name="tags[]" id="tags" multiple class="input-field">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create Recipe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
