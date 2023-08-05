<div class="relative">
    <div
        class="group aspect-h-7 aspect-w-10 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">

        <a href="{{ route('movies.show', $movie['id']) }}">
            <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}"
                class="pointer-events-none object-cover group-hover:opacity-75">
        </a>

    </div>
    <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900">
        {{ $movie['title'] }}
        {{ Carbon\Carbon::parse($movie['release_date'])->format('Y') }}
    </p>
</div>
