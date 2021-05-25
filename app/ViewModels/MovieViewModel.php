<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class MovieViewModel extends ViewModel
{
    public $movies;

    public function __construct($movie)
    {
        //
        $this->movies = $movie;
    }

    //view use name
    public function movies()
    {
        return collect($this->movies)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500'.$this->movies['poster_path'],
            'vote_average' => $this->movies['vote_average'] * 10 .'%',
            'release_date' => Carbon::parse($this->movies['release_date'])->format('M d, Y'),
            'release_year' => Carbon::parse($this->movies['release_date'])->format('Y'),
            'genres' => collect($this->movies['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->movies['credits']['crew'])->take(2),
            'cast' => collect($this->movies['credits']['cast'])->take(5),
            'images' => collect($this->movies['images']['backdrops'])->take(9),
        ])->only([
            'poster_path','id' ,'vote_average','release_date','genre_ids','title','overview','genres','images','crew','cast','videos','credits','release_year'
        ]);
    }
}
