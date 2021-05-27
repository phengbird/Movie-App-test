<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{   
    //to sign the view use name
    public $popularTv;
    public $topRatedTv;
    public $genres;

    public function __construct($popularTv,$topRatedTv,$genre)
    {
        $this->popularTv = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->genres = $genre;
    }

    public function popularTv()
    {
        return $this->formatMovies($this->popularTv);
    }

    public function topRatedTv()
    {
        return $this->formatMovies($this->topRatedTv);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    public function formatMovies($tv)
    {
        //  @foreach ($movies['genre_ids'] as $genre){{ $genres->get($genre) }}@if(!$loop->last),@endif @endforeach
        

        return collect($tv)->map(function($tvshow){
            $genresForm = collect($tvshow['genre_ids'])->mapWithKeys(function ($value) {
                return [$value=> $this->genres()->get($value)];
            })->implode(', ');

            return collect($tvshow)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'.$tvshow['poster_path'],
                'vote_average' => $tvshow['vote_average'] * 10 .'%',
                'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
                'genres' => $genresForm
            ])->only([
                'poster_path','id','vote_average','first_air_date','genre_ids','name','overview','genres'
            ]);
        });
    }

}
