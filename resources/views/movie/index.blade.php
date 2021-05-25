@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-16">
        
        <div class="popular-movies">

            <h2 class="uppercase font-semibold tracking-wider text-lg text-orange-500">
                Popular Movies
            </h2>

            <div class="grid grid-cols-1 sm:gird-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

                @foreach ($popularMovies as $movies)
                    <x-movie-card :movies="$movies" />
                @endforeach
        
            </div>

        </div>
        {{-- end of popular movie --}}

        <div class="now-playing-movie py-24">
            <h2 class="uppercase font-semibold tracking-wider text-lg text-orange-500">
                Now Playing
            </h2>
            <div class="grid grid-cols-1 sm:gird-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($nowPlayingMovies as $movies)
                    <x-movie-card :movies="$movies"/>
                @endforeach
            </div>
        </div>
        {{-- end of now playing --}}
    </div>

@endsection