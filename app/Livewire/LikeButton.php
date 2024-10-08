<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class LikeButton extends Component
{

    #[Reactive]
    public Post $post;


    public function toggleLike(){

        if(auth()->guest()){
            return $this->redirect(route('login'),true);
        }

        $user = auth()->user();

        if($user->hasLiked($this->post)){
            $user->likes()->detach($this->post);
            return;
        }

        $user->likes()->attach($this->post);

    }
    public function render()
    {
        // dd($this->post);
        return view('livewire.like-button');
    }
}
