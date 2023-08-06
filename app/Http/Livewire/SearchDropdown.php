<?php

namespace App\Http\Livewire;

use App\Repositories\TmdbRepository;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';

    public function render(TmdbRepository $tmdbRepository)
    {
        $searchResults = [];

        if (strlen($this->search) >= 2) {
            $searchResults = $tmdbRepository->searchMovies($this->search);
        }

        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->take(7),
        ]);
    }
}