
<div>

    <div class="flex flex-wrap w-full justify-around  gap-7 mt-5">
        <div>

                    <input wire:model='search' wire:keydown="updateee" type="search" placeholder="Search" class=" shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

        </div>
        <div>
            <button wire:click="sort()" class="flex">Sort by date
                @if ($asc)
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                  </svg>
                  @else
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                  </svg>
                  @endif

                            </button>
        </div>
    </div>

<div class='flex flex-wrap w-full items-center justify-center gap-7 mt-5'>


 @foreach($posts as $items)
            <a href="{{ route('detail', $items->id) }}" >
                <div class='w-[350px] h-[300px] relative hover:scale-[110%]'>

                    <img src="{{asset($items->image)}}" alt={title} class='object-cover w-full h-full absolute top-0 left-0 z-1' />
                    <div class='w-full h-full flex flex-col relative z-2 items-center justify-end p-3 bg-gradient-to-b from-transparent to-black font-thin'>
                        <p class='text-sm'>{{$items->title}}</p>
                        <p>{{$items->created_at}}</p>
                    </div>
                </div>
            </a>

            @endforeach
        </div>
            </div>
