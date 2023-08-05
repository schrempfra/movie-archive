<x-standard-layout>
    <div class="relative py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div
                class="-m-2 rounded-xl bg-gray-900/5 p-2 ring-1 ring-inset ring-gray-900/10 lg:-m-4 lg:rounded-2xl lg:p-4">
                <img src="https://image.tmdb.org/t/p/original/{{ $movie['backdrop_path'] }}" alt="App screenshot"
                    width="2432" height="1442" class="rounded-md shadow-2xl ring-1 ring-gray-900/10">
            </div>

            <div class="mt-16 flow-root sm:mt-24">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">{{ $movie['title'] }}</h1>

                <div class="mt-3">
                    @foreach ($movie['genres'] as $genre)
                        <span
                            class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                            {{ $genre['name'] }}
                        </span>
                    @endforeach
                </div>

                <p class="mt-6 text-lg leading-8 text-gray-600">
                    {{ $movie['overview'] }}
                </p>
            </div>

            <div class="relative isolate overflow-hidden bg-white py-20 sm:py-32 lg:overflow-visible">
                <div
                    class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-2 lg:items-start lg:gap-y-10">
                    <div
                        class="lg:col-span-2 lg:col-start-1 lg:row-start-1 lg:mx-auto lg:grid lg:w-full lg:max-w-7xl lg:grid-cols-2 lg:gap-x-8">
                        <div class="lg:pr-4">
                            <div class="lg:max-w-lg">
                                <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                                    {{ $movie['title'] }}
                                </h1>
                                <p class="mt-6 text-xl leading-8 text-gray-700">Aliquet nec orci mattis amet quisque
                                    ullamcorper neque, nibh sem. At arcu, sit dui mi, nibh dui, diam eget aliquam.
                                    Quisque id at vitae feugiat egestas.</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="-ml-12 -mt-12 p-12 lg:sticky lg:top-4 lg:col-start-2 lg:row-span-2 lg:row-start-1 lg:overflow-hidden">
                        <img class="w-[48rem] max-w-none rounded-xl bg-gray-900 shadow-xl ring-1 ring-gray-400/10 sm:w-[57rem]"
                            src="https://image.tmdb.org/t/p/original/{{ $movie['images']['backdrops'][1]['file_path'] }}"
                            alt="{{ $movie['title'] }}">
                    </div>
                    <div
                        class="lg:col-span-2 lg:col-start-1 lg:row-start-2 lg:mx-auto lg:grid lg:w-full lg:max-w-7xl lg:grid-cols-2 lg:gap-x-8">
                        <div class="lg:pr-4">
                            <div class="max-w-xl text-base leading-7 text-gray-700 lg:max-w-lg">
                                <p>Faucibus commodo massa rhoncus, volutpat. Dignissim sed eget risus enim. Mattis
                                    mauris semper sed amet vitae sed turpis id. Id dolor praesent donec est. Odio
                                    penatibus risus viverra tellus varius sit neque erat velit. Faucibus commodo massa
                                    rhoncus, volutpat. Dignissim sed eget risus enim. Mattis mauris semper sed amet
                                    vitae sed turpis id.
                                </p>

                                <h2 class="mt-16 text-2xl font-bold tracking-tight text-gray-900">
                                    Where to Watch {{ $movie['title'] }}
                                </h2>

                                <ul role="list" class="mt-8 space-y-8 text-gray-600">
                                    @if (array_key_exists('US', $providers['results']) && array_key_exists('flatrate', $providers['results']['US']))
                                        @foreach ($providers['results']['US']['flatrate'] as $provider)
                                            <li class="flex gap-x-3">
                                                <img class="w-1/2 col-span-2 col-start-2 max-h-12 w-full object-contain sm:col-start-auto lg:col-span-1"
                                                    src="https://image.tmdb.org/t/p/original/{{ $provider['logo_path'] }}"
                                                    alt="{{ $provider['provider_name'] }}">
                                                <span class="w-1/2">{{ $provider['provider_name'] }}</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>

                                <p class="mt-8">Et vitae blandit facilisi magna lacus commodo. Vitae sapien duis odio
                                    id et. Id blandit molestie auctor fermentum dignissim. Lacus diam tincidunt ac
                                    cursus in vel. Mauris varius vulputate et ultrices hac adipiscing egestas. Iaculis
                                    convallis ac tempor et ut. Ac lorem vel integer orci.</p>

                                <p class="mt-6">Id orci tellus laoreet id ac. Dolor, aenean leo, ac etiam consequat
                                    in. Convallis arcu ipsum urna nibh. Pharetra, euismod vitae interdum mauris enim,
                                    consequat vulputate nibh. Maecenas pellentesque id sed tellus mauris, ultrices
                                    mauris. Tincidunt enim cursus ridiculus mi. Pellentesque nam sed nullam sed diam
                                    turpis ipsum eu a sed convallis diam.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white py-6 sm:py-8 lg:py-12">
                <div class="mx-auto max-w-screen-2xl">
                    <div class="mb-4 flex items-center justify-between gap-8 sm:mb-8 md:mb-12">
                        <div class="flex items-center gap-12">
                            <h2 class="text-2xl font-bold text-gray-800 lg:text-3xl">Gallery</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:gap-6 xl:gap-8">
                        @foreach (array_slice($movie['images']['backdrops'], 0, 9) as $poster)
                            <a href="https://image.tmdb.org/t/p/original/{{ $poster['file_path'] }}"
                                class="group relative flex h-48 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-80">
                                <img src="https://image.tmdb.org/t/p/original/{{ $poster['file_path'] }}"
                                    loading="lazy" alt="poster"
                                    class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

                                <div
                                    class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-standard-layout>
