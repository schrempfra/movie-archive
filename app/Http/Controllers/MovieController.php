<?php

namespace App\Http\Controllers;

use App\Repositories\TmdbRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MovieController extends Controller
{   
    /**
     * @var TmdbRepository
     */
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
     */
    public function index()
    {
        //
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
     * 
     * @param string $id The $id parameter is a string that represents the ID of the movie.
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $id): View
    {            
        return view('movies.show', [
                        'movie' => $this->tmdbRepository->getMovie($id),
                        'providers' => $this->tmdbRepository->getMovieProviders($id),
                    ]);
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
