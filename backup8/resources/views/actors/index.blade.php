@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 py-16">
        
        <div class="popular-movies">

            <h2 class="uppercase font-semibold tracking-wider text-lg text-orange-500">
                Popular Actors
            </h2>

            <div class="grid grid-cols-1 sm:gird-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularActors as $actors)
                    <div class="actor mt-8">
                        <a href="{{ route('actors.show',$actors['id'])}}">
                            <img src=" {{$actors['profile_path']}} " alt="profile_image" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show',$actors['id'])}}" class="text-lg hover:text-gray-300">{{ $actors['name'] }}</a>
                            <div class="text-sm truncate text-gray-400">
                                {{$actors['known_for']}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
        {{-- end of popular actors --}}

        <div class="page-load-status my-8">
            <div class="flex justify-center">
                <p class="infinite-scroll-request spinner-defualt my-8 text-4xl">&nbsp;</p>
                <p class="infinite-scroll-last hidden">No more</p>
                <p class="infinite-scroll-error hidden">Error</p>
            </div>
        </div>

        {{-- for button next and previous --}}
        {{-- <div class="flex justify-between mt-16">
            @if ($previous)
                <a href="/actors/page/{{ $previous }}">Previous</a>
            @else
                <div></div>
            @endif
            @if ($next)
                <a href="/actors/page/{{ $next }}">Next</a>
            @else
                <div></div>
            @endif
        </div> --}}
    </div>

@endsection

@section('scripts')

    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        var elem = document.querySelector('.grid');
        var infScroll = new InfiniteScroll(elem , {
            path : '/actors/page/@{{#}}',
            append : '.actor',
            status : '.page-load-status'
            // history : false,
        });
    </script>
    
@endsection