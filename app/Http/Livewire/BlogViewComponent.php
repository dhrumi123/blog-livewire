<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;

class BlogViewComponent extends Component
{
    public $state = [];

    public function mount($blog)
    {
        // Load the blog post by ID
        $this->blog = Blog::findOrFail($blog);
    }

    public function render()
    {
        return view('livewire.blog-view-component');
    }
}
