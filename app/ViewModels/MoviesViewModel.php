<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{   
    //to sign the view use name
    public $popularMovies;
    public $nowPlayingMovies;
    public $genres;

    public function __construct($popularMovies,$nowPlayingMovies,$genre)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genres = $genre;
    }

    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }

    public function nowPlayingMovies()
    {
        return $this->formatMovies($this->nowPlayingMovies);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    public function formatMovies($movie)
    {
        //  @foreach ($movies['genre_ids'] as $genre){{ $genres->get($genre) }}@if(!$loop->last),@endif @endforeach
        

        return collect($movie)->map(function($movie){
            $genresForm = collect($movie['genre_ids'])->mapWithKeys(function ($value) {
                return [$value=> $this->genres()->get($value)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 .'%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresForm
            ])->only([
                'poster_path','id','vote_average','release_date','genre_ids','title','overview','genres'
            ]);
        });
    }

}
