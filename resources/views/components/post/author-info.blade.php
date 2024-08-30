@props(['author','size'])

@php
    $size = match ($size) {
         'sm'=> 'w-7 h-7',
         'mm'=> 'w-10 h-10',
         'lg'=> 'w-13 h-13',
         default=> 'w-10 h-10'
    }
@endphp


<img class="{{$size}} rounded-full mr-3" src="{{ $author->profile_photo_url }}" alt="{{ $author->name }}">
<span class="mr-1 text-xs">{{ $author->name }}</span>
