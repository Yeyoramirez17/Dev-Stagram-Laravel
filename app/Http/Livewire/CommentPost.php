<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Collection;
use Livewire\Component;

class CommentPost extends Component
{
    public ?Post $post = null;
    public $comment;
    public $count = 3;
    protected $rules = [
        'comment' => ['required', 'max:255'],
    ];
    public function mount( Post $post )
    {
        $this->post = $post;
    }
    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }
    public function render() {
        return view('livewire.comment-post');
    }
    public function save() {
        $this->validate();

        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $this->post->id ,
            'comment' => $this->comment
        ]);

        $this->reset( 'comment' );

        session()->flash('info', 'The Comment have been added successful.');
        session()->flash('type', 'success');

        // session()->flash('info','The Comment have been added successful.');
    }
    public function getCommentsProperty() {
        return $this->post->comments()
            ->orderBy('created_at', 'desc')
            ->take($this->count)
            ->get();
    }
}
