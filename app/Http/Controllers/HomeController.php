<?php

namespace App\Http\Controllers;

use App\Repositories\TmdbRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $tmdbRepository;

    /**
     * Create a new controller instance.
     * 
     * @param TmdbRepository $tmdbRepository
     */
    public function __construct(TmdbRepository $tmdbRepository)
    {
        $this->tmdbRepository = $tmdbRepository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {   
        return view('home', [
            'trendingMovies' => $this->tmdbRepository->getTrendingMoviesWithoutPaginator(
                                    $request->query(TmdbRepository::PAGE_NAMES['trending'], 1), 8
                                ),

            'popularMovies' => $this->tmdbRepository->getPopularMoviesWithoutPaginator(
                                    $request->query(TmdbRepository::PAGE_NAMES['popular'], 1), 8
                                ),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
