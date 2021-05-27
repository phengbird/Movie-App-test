@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-16">
        
        <div class="popular-tv">

            <h2 class="uppercase font-semibold tracking-wider text-lg text-orange-500">
                Popular Shows
            </h2>

            <div class="grid grid-cols-1 sm:gird-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularTv as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
                @endforeach
            </div>

        </div>
        {{-- end of popular tv --}}

        <div class="now-playing-show py-24">
            <h2 class="uppercase font-semibold tracking-wider text-lg text-orange-500">
                Top Rated Shows
            </h2>
            <div class="grid grid-cols-1 sm:gird-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($topRatedTv as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
                @endforeach
            </div>
        </div>
        {{-- end of Top Rate Tv  --}}
    </div>

@endsection