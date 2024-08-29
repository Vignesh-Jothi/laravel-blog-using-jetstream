@props(['post'])

<div class="">
    <a href="#">
        <div>
            <img class="w-full rounded-xl" src="{{ $post->getThumbnailUrl() }}">
        </div>
    </a>
    <div class="mt-3">
        <div class="flex items-center mb-2 gap-2">
            @if ($category = $post->category()->first())
                <x-badge wire:navigate href="{{ route('posts.index', ['category' => $category->slug]) }}"
                    :textColor="$category->text_color" :bgColor="$category->bg_color">
                    {{ $category->title }}
                </x-badge>
            @endif
            <p class="text-gray-500 text-sm">{{ $post->published_at->format('d-m-Y') }}</p>
        </div>
        <a href="#" class="text-xl font-bold text-gray-900">{{ $post->title }}</a>
    </div>

</div>
