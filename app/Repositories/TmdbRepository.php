<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TmdbRepository
{
    protected $baseUrl = 'https://api.themoviedb.org/3/';

    protected $token;

    protected const CACHE_TIME = 60 * 60 * 24;

    // define all page names here
    const PAGE_NAMES =
    [
        'trending' => 'trending',
        'popular' => 'popular',
        'topRated' => 'topRated',
    ];

    public function __construct()
    {
        $this->token = config('services.tmdb.token');
    }

    /**
     * The function makes an API call using a given URL and returns a paginated result.
     *
     * @param string $url The $url parameter is a string that represents the endpoint or route of the
     * API that you want to call. It is appended to the base URL to form the complete URL for the API
     * call.
     * @param int $page The $page parameter is used to specify the page number
     * @param string $pageName The $pageName parameter is used to specify the name of the page
     * @return LengthAwarePaginator
     */
    protected function makeApiCall(string $url, int $page, string $pageName): LengthAwarePaginator
    {
        return $this->paginate(
            $this->errorHandling(
                $this->cacheApiCall(
                    Http::withToken($this->token)
                        ->get($this->baseUrl . $url . '?page=' . $page)
                        ->json(),
                    $page,
                    $pageName
                )
            ),
            $pageName
        );
    }

    /**
     * The function makes an API call without using a paginator and returns the response as an array.
     *
     * @param string $url The URL of the API endpoint you want to call.
     * @param int $page The $page parameter is an integer that represents the page number of the API
     * call. It is used to specify which page of data to retrieve from the API.
     * @param string $pageName The $pageName parameter is a string that represents the name of the page
     * being requested. It is used to identify the specific page in the cache and error handling logic.
     *
     * @return Collection
     */
    protected function makeApiCallWithoutPaginator(string $url, int $page, string $pageName): Collection
    {
        return Collection::make($this->errorHandling(
            $this->cacheApiCall(
                Http::withToken($this->token)
                    ->get($this->baseUrl . $url . '?page=' . $page)
                    ->json(),
                $page,
                $pageName
            )
        ));
    }

    /**
     * The cacheApiCall function takes an array of results, a page number, and a page name, and caches
     * the results using the Laravel Cache::remember method.
     *
     * @param array $results An array containing the results of an API call.
     * @param int $page The $page parameter is an integer that represents the current page number. It
     * is used to generate a unique cache key for each page of results.
     * @param string $pageName The $pageName parameter is a string that represents the name or
     * identifier of the page for which the API call is being cached. It is used to create a unique
     * cache key for storing and retrieving the cached results.
     *
     * @return array
     */
    protected function cacheApiCall(array $results, int $page, string $pageName): array
    {
        return Cache::remember($pageName . '_' . $page, self::CACHE_TIME, function () use ($results) {
            return $results;
        })['results'];
    }

    /**
     * The errorHandling function checks if a status code exists in the results array and aborts the
     * execution with the corresponding status code and message.
     *
     * @param array $results
     */
    protected function errorHandling(array $results): array
    {
        if (array_key_exists('success', $results)) {
            if ($results['success'] === false) {
                abort(404);
            }
        }

        return $results;
    }

    /**
     * The function returns a paginated result using the LengthAwarePaginator class in PHP.
     *
     * @param array $response The response from the TMDB API.
     * @param string $pageName The name of the page.
     * @return LengthAwarePaginator
     */
    protected function paginate(array $response, string $pageName): LengthAwarePaginator
    {
        return new LengthAwarePaginator(
            $response['results'],
            $response['total_results'],
            count($response['results']),
            $response['page'],
            [
                'path' => request()->url(),
                'query' => request()->query(),
                'fragment' => null,
                'pageName' => $pageName,
            ],
        );
    }

    /**
     * The function getTrendingMovies retrieves trending movies from the TMDB API
     *
     * @param int $page It is an integer value that determines which page of results to fetch.
     *
     * @return LengthAwarePaginator $paginator.
     */
    public function getTrendingMovies(int $page = 1): LengthAwarePaginator
    {
        return $this->makeApiCall('trending/movie/day', $page, self::PAGE_NAMES['trending']);
    }

    /**
     * The function getPopularMovies retrieves popular movies from the TMDB API
     *
     * @param int $page It is an integer value that determines which page of results to fetch.
     *
     * @return LengthAwarePaginator $paginator.
     */
    public function getPopularMovies(int $page = 1): LengthAwarePaginator
    {
        return $this->makeApiCall('movie/popular', $page, self::PAGE_NAMES['popular']);
    }

    /**
     * The function getTopRatedMovies retrieves popular movies from the TMDB API
     *
     * @param int $page It is an integer value that determines which page of results to fetch.
     *
     * @return LengthAwarePaginator $paginator.
     */
    public function getTopRatedMovies(int $page = 1): LengthAwarePaginator
    {
        return $this->makeApiCall('movie/top_rated', $page, self::PAGE_NAMES['topRated']);
    }

    /**
     * The function getTrendingMoviesWithoutPaginator retrieves trending movies from the TMDB API
     *
     * @param int $page It is an integer value that determines which page of results to fetch.
     *
     * @return Collection.
     */
    public function getTrendingMoviesWithoutPaginator(int $page = 1, int $limit): Collection
    {
        return $this->makeApiCallWithoutPaginator('trending/movie/day', $page, self::PAGE_NAMES['trending'])->take($limit);
    }

    /**
     * The function getPopularMoviesWithoutPaginator retrieves popular movies from the TMDB API
     *
     * @param int $page It is an integer value that determines which page of results to fetch.
     *
     * @return Collection.
     */
    public function getPopularMoviesWithoutPaginator(int $page = 1, int $limit): Collection
    {
        return $this->makeApiCallWithoutPaginator('movie/popular', $page, self::PAGE_NAMES['popular'])->take($limit);
    }

    /**
     * The function getTopRatedMoviesWithoutPaginator retrieves top rated movies from the TMDB API
     *
     * @param int $page It is an integer value that determines which page of results to fetch.
     *
     * @return Collection.
     */
    public function getTopRatedMoviesWithoutPaginator(int $page = 1, int $limit): Collection
    {
        return $this->makeApiCallWithoutPaginator('movie/top_rated', $page, self::PAGE_NAMES['topRated'])->take($limit);
    }


    /**
     * The function getMovie retrieves movie data from the TMDB API using a provided ID and returns it as
     * an array.
     *
     * @param $id The id parameter is the unique identifier of the movie that you want to retrieve
     * information for.
     *
     * @return array an array.
     */
    public function getMovie($id): array
    {
        return $this->errorHandling(Http::withToken($this->token)
            ->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images,providers')
            ->json());
    }

    /**
     * The function getMovieProviders retrieves information about the streaming providers for a
     * specific movie using the TMDB API.
     *
     * @param $id The id parameter is the unique identifier of a movie. It is used to specify which
     * movie's providers you want to retrieve.
     *
     * @return array
     */
    public function getMovieProviders($id): array
    {
        return $this->errorHandling(Http::withToken($this->token)
            ->get('https://api.themoviedb.org/3/movie/' . $id . '/watch/providers')
            ->json());
    }

    /**
     * The function searchMovies uses the TMDB API to search for movies based on a given search query
     * and returns an array of the search results.
     * 
     * @param string $search The search parameter is a string that represents the movie title or keyword
     * that you want to search for.
     * 
     * @return array
     */
    public function searchMovies(string $search): array
    {
        return $this->errorHandling(Http::withToken($this->token)
                ->get('https://api.themoviedb.org/3/search/movie?query='. $search)
                ->json())['results'];
    }
}