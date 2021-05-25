
<div class="relative mt-3 md:mt-0" x-data="{isOpen:true}"} @click.away="isOpen = false">
    <input 
        wire:model.debounce.500ms="search" 
        type="text" 
        class="bg-gray-800 text-sm rounded-full w-64 px-4 pl-8 py-1 focus:shadow-outline focus:outline-none" 
        {{-- for segment(1) also can use this Request::is(movies/*) --}}
        {{-- @if (\Request::segment(1) === 'movies' || \Request::is('/'))
            placeholder="Movies Name"
        @elseif (\Request::is('actors/*') || \Request::is('actors'))
            placeholder="Actors Name"
        @elseif(\Request::is('tv') || \Request::is('tv/*'))
            placeholder="Tv Name"
        @endif --}}
        placeholder="Search (Press '/' to focus)"
        x-ref="search"
        @keydown.window="
            if(event.keyCode === 191) {
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen=true"
        @keydown="isOpen=true"
        @keydown.escape.window="isOpen=false"
        @keydown.shift.tab="isOpen=false"
    >
        <div class="absolute top-0">
            <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/></svg>
        </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>
    @if (strlen($search ) >= 2)
        <div 
        class="z-50 absolute bg-gray-800 rounded w-64 mt-4 text-sm" 
        x-show.transition.opacity="isOpen" 
        @keydown.escape.window="isOpen = false"
        >
            @if ($searchResults->count() >0)
                <ul>
                    @foreach ($searchResults as $results)
                        <li class="border-b border-gray-700">
                            {{-- @if (\Request::is('/') || \Request::is('movies/*'))
                                <a 
                                    href="{{ route('movie.show' , $results['id']) }}" class="block hover:bg-gray-700 px-3 py-3 flex items-center"
                                    @if ($loop->last) @keydown.tab = "isOpen=false" @endif
                                    >
                                    @if ($results['poster_path'])
                                        <img src="https://image.tmdb.org/t/p/w92/{{ $results['poster_path'] }}" alt="poster" class="w-10">
                                    @else
                                        <img src="https://via.placeholder.com/50x72" alt="poster" class="w-10">
                                    @endif
                                    <span class="ml-4">{{ $results['title'] }}</span>
                                </a>

                            @elseif (\Request::is('actors') || \Request::is('actors/*'))
                                <a 
                                    href="{{ route('actors.show' , $results['id']) }}" class="block hover:bg-gray-700 px-3 py-3 flex items-center"
                                    @if ($loop->last) @keydown.tab = "isOpen=false" @endif
                                    >
                                    @if ($results['profile_path'])
                                        <img src="https://image.tmdb.org/t/p/w92/{{ $results['profile_path'] }}" alt="profile" class="w-10">
                                    @else
                                        <img src="https://via.placeholder.com/50x72" alt="poster" class="w-10">
                                    @endif
                                    <span class="ml-4">{{ $results['name'] }}</span>
                                </a>
                                
                            @else 
                                <a 
                                    href="{{ route('actors.show' , $results['id']) }}" class="block hover:bg-gray-700 px-3 py-3 flex items-center"
                                    @if ($loop->last) @keydown.tab = "isOpen=false" @endif
                                    >
                                    @if ($results['poster_path'])
                                        <img src="https://image.tmdb.org/t/p/w92/{{ $results['poster_path'] }}" alt="poster" class="w-10">
                                    @else
                                        <img src="https://via.placeholder.com/50x72" alt="poster" class="w-10">
                                    @endif
                                    <span class="ml-4">{{ $results['name'] }}</span>
                                </a>
                            @endif --}}
                            <a 
                                href="{{ route('movie.show' , $results['id']) }}" class="block hover:bg-gray-700 px-3 py-3 flex items-center"
                                @if ($loop->last) @keydown.tab = "isOpen=false" @endif
                                >
                                @if ($results['poster_path'])
                                    <img src="https://image.tmdb.org/t/p/w92/{{ $results['poster_path'] }}" alt="poster" class="w-10">
                                @else
                                    <img src="https://via.placeholder.com/50x72" alt="poster" class="w-10">
                                @endif
                                <span class="ml-4">{{ $results['title'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">No Search for "{{$search}}"</div>
            @endif
        </div>
    @endif
</div>