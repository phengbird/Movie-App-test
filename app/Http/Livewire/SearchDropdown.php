<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;


class SearchDropdown extends Component
{
    public $search = "";
    public $url = "";
    public $com = "";
    public $currentUrl = "";

    public function render()
    {
        $searchResults = [];
        
        $this->url = parse_url(url()->previous());
        $this->currentUrl = parse_url(url()->current());
        if(count(parse_url(url()->current())) > 3)
            $this->com = $this->url['path'];

        if(count($this->currentUrl) < 4 || $this->url['path'] == '/' || str_contains($this->com , 'movies')) {
            if(strlen($this->search) >= 2) {
                $searchResults = Http::withToken(config('services.tmdb.token'))
                    ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search)
                    ->json()['results'];
            }
        } elseif($this->url['path'] == '/actors' || strpos($this->com , 'actors')) {
            if(strlen($this->search) >= 2) {
                $searchResults = Http::withToken(config('services.tmdb.token'))
                    ->get('https://api.themoviedb.org/3/search/person?query='.$this->search)
                    ->json()['results'];
            }
        } elseif($this->url['path'] == '/tv' || str_contains($this->com , 'tv')) {
            
            if(strlen($this->search) >= 2) {
                $searchResults = Http::withToken(config('services.tmdb.token'))
                    ->get('https://api.themoviedb.org/3/search/tv?query='.$this->search)
                    ->json()['results'];
            };
        }
        
        return view('livewire.search-dropdown',[
            'searchResults' => collect($searchResults)->take(7),
        ]);
        
        
    }
}
