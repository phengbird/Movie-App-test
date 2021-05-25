@extends('layouts.main')

@section('content')
    <div class="movie-info  border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-none md:flex-row flex-col">
            <img src=" {{ $movies['poster_path'] }} " alt="{{$movies['title']}}" class="w-64 md:w-96">

            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $movies['title'].'('. $movies['release_year'] .')'}}</h2>
                <div class="flex flex-warp item-center text-gray-400 text-sm">
                    <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
                    <span class="ml-1">{{ $movies['vote_average']  }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $movies['release_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>
                        {{-- @foreach ($movies['genres'] as $gen)
                            {{ $gen['name']}}
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach --}}
                        {{$movies['genres']}}
                    </span>
                </div>

                <p class="text-gray-300 mt-8">
                    {{ $movies['overview'] }}
                </p>

                <div class="mt-12">
                    <h4 class="text-white font-semibold">
                        Featured Cast
                    </h4>
                    
                    <div class="flex mt-4">
                        @foreach ($movies['crew'] as $crew)
                            <div class="mr-8">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div x-data="{isOpen:false}">
                    @if (count($movies['videos']['results']) > 0)
                        <div class="mt-12">
                            <button 
                                @click="isOpen=true"
                                 class="flex inline-flex items-center rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150 bg-orange-500"
                            >
                                <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>
                    @endif
                
               
                    <div 
                        style="background-color: rgba(0,0,0,.5)"
                        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                        x-show.transition.opacity="isOpen"
                        >
                        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                            <div class="bg-gray-900 rounded">
                                <div class="flex justify-end pr-4 pt-4">
                                    <button @click="isOpen=false" class="text-3xl leading-none hover:text-gray-300">&times;</button>
                                </div>
                                <div class="modal-body px-8 py-8">
                                    <div class="responsive-container overflow-hidden relative" style="padding-top:56.25%">
                                        {{-- src check watch?v to embed example:"https://www.youtube.com/embed/a_DjOcnzb14"--}}
                                        <iframe width="560" height="315" class="responsive-iframe absolute top-0 left-0 h-full w-full" src="https://youtube.com/embed/{{ $movies['videos']['results'][0]['key']}}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div> {{-- end movie-info --}}

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($movies['cast'] as $cast)
                    <div class="mt-8">
                        <a href="{{ route('actors.show',$cast['id'])}}">
                            <img src=" {{"https://image.tmdb.org/t/p/w300".$cast['profile_path']}} " alt="{{$cast['name']}}" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show',$cast['id'])}}" class="text-lg mt-2 hover:text-gray:300">{{ $cast['name'] }}</a>
                            <div class="text-sm text-gray-400">
                                {{ $cast['character'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> <!-- end movie-cast -->
    
    <div class="movie-images" x-data="{isOpen:false,iamge:''}">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($movies['images'] as $image)
                    <div class="mt-8">
                        <button 
                            @click.prevent="
                                isOpen=true
                                image='{{"https://image.tmdb.org/t/p/original/".$image['file_path'] }}'
                            "
                            href="#"
                            >
                            <img src=" {{"https://image.tmdb.org/t/p/w500".$image['file_path'] }}" alt="" class="hover:opacity-75 transition ease-in-out duration-150">
                        </button>
                    </div>
                @endforeach
            </div>

            <div 
                style="background-color: rgba(0,0,0,.5)"
                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                x-show.transition.opacity="isOpen"
                >
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-4">
                            <button 
                                @click="isOpen=false" 
                                @keydown.escape.window="isOpen=false"
                                class="text-3xl leading-none hover:text-gray-300"
                            >&times;</button>
                        </div>
                        <div class="modal-body px-8 py-8">
                                <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection