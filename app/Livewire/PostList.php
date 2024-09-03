<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\ErrorSolutions\Solutions\Concerns\IsProvidedByFlare;

class PostList extends Component
{
    use WithPagination;
    #[Url()]
    public $sort = 'desc';

    #[Url()]
    public $search = '';

    #[Url()]
    public $category = '';
    public function setSorting($sort)
    {
        $this->sort = $sort === 'desc' ? 'desc' : 'asc';
        $this->resetPage();
    }

    #[On('search')]
    public function updatedSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
        // dd('search');
    }

    public function resetSearch(){
        $this->search = "";
        $this->category = "";
        $this->resetPage();
    }


    public function activeCategory(){
        if($this->category === null || $this->category === ""){
            return null;
        }
        return Category::where('slug',$this->category)->first();
    }

    #[Computed]
    public function posts()
    {
        
        return Post::published()
            ->with('author')
            ->orderBy('published_at', $this->sort)
            ->when($this->activeCategory() !== null,function($query){

                $query->showCategory($this->category);
               
            })
            ->where('title','like',"%{$this->search}%")
            ->paginate(5);
    }
    public function render()
    {
        return view('livewire.post-list');
    }
}
