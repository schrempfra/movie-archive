<x-standard-layout>
    <div class="container-full py-6 px-4 sm:px-6 lg:px-8 pt-16">
        <div class="trending-movies pb-24">
            <h2 class="text-2xl font-bold mb-4">Trending Movies</h2>
            <div role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-4 sm:gap-x-6 lg:grid-cols-8 xl:gap-x-8">
                @foreach ($trendingMovies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
            </div>
        </div>

        <div class="popular-movies pb-24">
            <h2 class="text-2xl font-bold">Popular Movies</h2>
            <div role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-4 sm:gap-x-6 lg:grid-cols-8 xl:gap-x-8">
                @foreach ($popularMovies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
            </div>
        </div>

        <div class="top-rated-movies pb-24">
            <h2 class="text-2xl font-bold">Top Rated</h2>
            <div role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-4 sm:gap-x-6 lg:grid-cols-8 xl:gap-x-8">
                @foreach ($topRated as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
            </div>
        </div>
    </div>
</x-standard-layout>
