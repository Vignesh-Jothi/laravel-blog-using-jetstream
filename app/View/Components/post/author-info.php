<?php

namespace App\View\Components\post;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class author-info extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post.author-info');
    }
}
