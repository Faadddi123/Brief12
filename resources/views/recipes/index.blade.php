
<x-app-layout>


    




    <body class="mb-48">


        <!-- Hero -->
        <section
            class="relative h-72 bg-laravel flex flex-col justify-center align-center text-center space-y-4 mb-4"
        >
            <div
                class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
                style="background-image: url('images/laravel-logo.png')"
            ></div>

            <div class="z-10">
                <h1 class="text-6xl font-bold uppercase text-white">
                    Lara<span class="text-black">Gigs</span>
                </h1>
                <p class="text-2xl text-gray-200 font-bold my-4">
                    Find or post Laravel jobs & projects
                </p>
                <div>
                    <a
                        href="register.html"
                        class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black"
                        >Sign Up to List a Gig</a
                    >
                </div>
            </div>
        </section>

        <main>
            <!-- Search -->
            <form action="">
                <div class="relative border-2 border-gray-100 m-4 rounded-lg">
                    <div class="absolute top-4 left-3">
                        <i
                            class="fa fa-search text-gray-400 z-20 hover:text-gray-500"
                        ></i>
                    </div>
                    <input
                        type="text"
                        name="search"
                        class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
                        placeholder="Search Laravel Gigs..."
                    />
                    <div class="absolute top-2 right-2">
                        <button
                            type="submit"
                            class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600"
                        >
                            Search
                        </button>
                    </div>
                </div>
            </form>

            <div
                class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4"
            >
                @foreach($recipes as $recipe)
                <div class="bg-gray-50 border border-gray-200 rounded p-6">
                    <div class="flex">
                        <img
                            class="hidden w-48 mr-6 md:block"
                            src="{{ asset('storage/images/' . $recipe->image) }}"
                            alt="{{ $recipe->title }}"
                        />
                        <div>
                            <h3 class="text-2xl">
                                <a href="show.html">{{ $recipe->title }}</a>
                            </h3>
                            <div class="text-xl font-bold mb-4">
                            @if ($recipe->category)
                            {{ $recipe->category->name }}
                            @else
                            No categories
                            @endif


                            
                            </div>
                            <ul class="flex">
                                @if ($recipe->tags && $recipe->tags->isNotEmpty())
                                    @foreach ($recipe->tags as $tag)
                                        <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                                            <a href="#">{{ $tag->name }}</a>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="flex items-center justify-center bg-red-500 text-white rounded-xl py-1 px-3 mr-2 text-xs">
                                            <a href="#">No tags</a>
                                    </li>
                                @endif
                            </ul>
                            <div class="text-lg mt-4">
                                <div class = "flex justify-between">
                                    <a href="{{ route('recipes.show', $recipe->id) }}" class="text-blue-500">View Details</a>

                                    <a href="{{ route('recipes.edit', $recipe->id) }}" class="text-blue-500">Edit</a>

                                    <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this recipe?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-blue-500">Delete</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </main>

        <footer
            class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center"
        >
            <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

            <a
                href="create.html"
                class="absolute top-1/3 right-10 bg-black text-white py-2 px-5"
                >Post Job</a
            >
        </footer>

</body>


</x-app-layout>

