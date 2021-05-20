<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use League\CommonMark\Extension\Footnote\Node\Footnote;
use Tests\TestCase;

class ViewMovieTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    // public function testBasicTest()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    
    /**
     * @test
     *
     */
    public function the_main_page_shows_correct_info()
    {
        Http::fake([
            // 'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovie(),
            // 'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlayingMovie(),
            'https://api.themoviedb.org/3/genre/movie/list' => $this->fakeGenres(),
        ]);
        $response = $this->get(route('movie.index'));
        
        $response->assertSuccessful();

        // $response->assertSee('Popular Movies');
        // $response->assertSee('Fake Movie');
        // $response->assertSee('Adventure, Drama, Mystery, Science Fiction, Thriller'); //can use this to test and solve at main-card.blade
        // $response->assertSee('Now Playing');
        // $response->assertSee('Now Playing Fake Movie');
    }

    // example from controller dd($Genres) to know
    public function fakeGenres()
    {
        return Http::response([
                'genres' => [
                    [
                      "id" => 28,
                      "name" => "Action"
                    ],
                    [
                      "id" => 12,
                      "name" => "Adventure"
                    ],
                    [
                      "id" => 16,
                      "name" => "Animation"
                    ],
                    [
                      "id" => 35,
                      "name" => "Comedy"
                    ],
                    [
                      "id" => 80,
                      "name" => "Crime"
                    ],
                    [
                      "id" => 99,
                      "name" => "Documentary"
                    ],
                    [
                      "id" => 18,
                      "name" => "Drama"
                    ],
                    [
                      "id" => 10751,
                      "name" => "Family"
                    ],
                    [
                      "id" => 14,
                      "name" => "Fantasy"
                    ],
                    [
                      "id" => 36,
                      "name" => "History"
                    ],
                    [
                      "id" => 27,
                      "name" => "Horror"
                    ],
                    [
                      "id" => 10402,
                      "name" => "Music"
                    ],
                    [
                      "id" => 9648,
                      "name" => "Mystery"
                    ],
                    [
                      "id" => 10749,
                      "name" => "Romance"
                    ],
                    [
                      "id" => 878,
                      "name" => "Science Fiction"
                    ],
                    [
                      "id" => 10770,
                      "name" => "TV Movie"
                    ],
                    [
                      "id" => 53,
                      "name" => "Thriller"
                    ],
                    [
                      "id" => 10752,
                      "name" => "War"
                    ],
                    [
                      "id" => 37,
                      "name" => "Western"
                    ],
                ]
            ], 200);
    }
}
