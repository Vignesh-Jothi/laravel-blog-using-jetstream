<div id="posts" class=" px-3 lg:px-7 py-6">
    <div class="flex justify-between items-center border-b border-gray-100">
        <div class="text-gray-500">
            @if($this->activeCategory() || $search)
            <button class="gray-500 text-xs mr-3" wire:click="resetSearch()">X</button>
            @endif
            @if ($this->activeCategory())
                <x-badge wire:navigate href="{{ route('posts.index', ['category' => $this->activeCategory()->slug]) }}"
                    :textColor="$this->activeCategory()->text_color" :bgColor="$this->activeCategory()->bg_color">
                    {{ $this->activeCategory()->title }}
                </x-badge>
            @endif
            @if ($search)
                containing : <strong>{{ $search }}</strong>
            @endif
        </div>
        <div id="filter-selector" class="flex items-center space-x-4 font-light ">
            <button class="{{ $sort === 'desc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4"
                wire:click="setSorting('desc')">Latest</button>
            <button class="{{ $sort === 'asc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4 "
                wire:click="setSorting('asc')">Oldest</button>
        </div>
    </div>
    <div class="py-4">
        @foreach ($this->posts as $post)
            <x-post.post-artical :key="'post-'.$post->id" :post="$post" />
        @endforeach

    </div>

    <div class="my-3">
        {{ $this->posts->onEachSide(1)->links() }}
    </div>
</div>
