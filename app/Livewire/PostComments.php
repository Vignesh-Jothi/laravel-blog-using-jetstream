<?php



namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;

class PostComments extends Component
{
    use WithPagination;
    public Post $post;

    #[Rule('required|min:3|max:190')]
    public string $comment;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function postComment()
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }
        

        // Validate the comment field
        $this->validate();

        // Create the comment associated with the post and the authenticated user
        $this->post->comments()->create([
            'comment' => $this->comment,  
            'user_id' => Auth::id(),
        ]);

        // Reset the comment input field
        $this->reset('comment');
    }

    #[Computed]
    public function comments()
    {
        return $this->post?->comments()->latest()->paginate(6);
    }

    public function render()
    {
        return view('livewire.post-comments');
    }
}
