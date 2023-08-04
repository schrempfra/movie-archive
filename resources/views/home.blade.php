<x-standard-layout>
    <div class="container-full mx-auto py-6 px-4 sm:px-6 lg:px-8"> 
        <h2 class="text-2xl font-bold mb-4">Trending Movies</h2>
        <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-4 sm:gap-x-6 lg:grid-cols-8 xl:gap-x-8">
            @foreach ($trendingMovies as $movie)
                <li class="relative">
                    <div class="group aspect-h-7 aspect-w-10 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                        
                        <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}"
                            alt="" class="pointer-events-none object-cover group-hover:opacity-75">

                        <button type="button" class="absolute inset-0 focus:outline-none">
                            <span class="sr-only">{{ $movie['title'] }}</span>
                        </button>
                    </div>
                    <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900">
                        {{ $movie['title'] }}
                        {{ Carbon\Carbon::parse($movie['release_date'])->format('Y') }}
                    </p>
                </li>
            @endforeach
        </ul>

        <h2 class="text-2xl font-bold mb-4 mt-20">Popular Movies</h2>
        <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-4 sm:gap-x-6 lg:grid-cols-8 xl:gap-x-8">
            @foreach ($popularMovies as $movie)
                <li class="relative">
                    <div class="group aspect-h-7 aspect-w-10 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                        
                        <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}"
                            alt="" class="pointer-events-none object-cover group-hover:opacity-75">

                        <button type="button" class="absolute inset-0 focus:outline-none">
                            <span class="sr-only">{{ $movie['title'] }}</span>
                        </button>
                    </div>
                    <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900">
                        {{ $movie['title'] }}
                        {{ Carbon\Carbon::parse($movie['release_date'])->format('Y') }}
                    </p>
                </li>
            @endforeach
        </ul>

        <h2 class="text-2xl font-bold mb-4 mt-20">Top Rated</h2>
        <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-4 sm:gap-x-6 lg:grid-cols-8 xl:gap-x-8">
            @foreach ($topRated as $movie)
                <li class="relative">
                    <div class="group aspect-h-7 aspect-w-10 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                        
                        <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}"
                            alt="" class="pointer-events-none object-cover group-hover:opacity-75">

                        <button type="button" class="absolute inset-0 focus:outline-none">
                            <span class="sr-only">{{ $movie['title'] }}</span>
                        </button>
                    </div>
                    <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900">
                        {{ $movie['title'] }}
                        {{ Carbon\Carbon::parse($movie['release_date'])->format('Y') }}
                    </p>
                </li>
            @endforeach
        </ul>
    </div>
</x-standard-layout>
