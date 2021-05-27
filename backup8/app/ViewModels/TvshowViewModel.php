<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class TvshowViewModel extends ViewModel
{
    public $tvshow;

    public function __construct($tvshow)
    {
        //
        $this->tvshow = $tvshow;
    }

    //view use name
    public function tvshow()
    {
        return collect($this->tvshow)->merge([
            'poster_path' => $this->tvshow['poster_path'] ? 'https://image.tmdb.org/t/p/w500'.$this->tvshow['poster_path'] : '/img/no-image.jpg',
            'vote_average' => $this->tvshow['vote_average'] * 10 .'%',
            'first_air_date' => Carbon::parse($this->tvshow['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->tvshow['credits']['crew'])->take(2),
            'cast' => collect($this->tvshow['credits']['cast'])->take(5)->map(function ($cast){
                return collect($cast)->merge([
                    'profile_path' => $cast['profile_path'] ? 'https://image.tmdb.org/t/p/w300'.$cast['profile_path'] : 'https://via.placeholder.com/300x450'
                ]);
            }),
            'images' => collect($this->tvshow['images']['backdrops'])->take(9),
        ])->only([
            'poster_path','id','vote_average','first_air_date','genre_ids','name','overview','genres','images','crew','cast','videos','credits','created_by'
        ]);
    }
}
