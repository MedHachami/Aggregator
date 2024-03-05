<x-layouts.client-layout title="{{$category}}">

        <div >
{{--            <livewire:pages-categories :category="$category" />--}}
            @livewire('pages-categories', ['category' => $category])
        </div>





</x-layouts.client-layout>
