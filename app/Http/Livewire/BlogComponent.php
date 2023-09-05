<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;

class BlogComponent extends Component
{
    public $state = [];

    public $updateBlog = false;
    public $status = 0;
    
    public function render()
    {
        $blogs = Blog::latest()->get();
       
        return view('livewire.blog-component',
        [
            'blogs' => $blogs
        ]);
    }
     
    public function confirmblogRemoval($blogId) {
        
        $this->blogIdBeingRemoved = $blogId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

      //delete User
      public function deleteBlog() {
     
        $blog = Blog::findOrFail($this->blogIdBeingRemoved);
        $blog->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Blog deleted successfully!']);        
    }

    public function confirmChangeStatus($blogId) {
        
        $this->blogIdBeingChanged = $blogId;
        $this->dispatchBrowserEvent('show-confirmation-modal');
    }
    
    public function changeStatus() {
        $blog = Blog::findOrFail( $this->blogIdBeingChanged );
        $blog->status = $blog->status == 1 ? 0 : 1;
        $blog->save(); 

        $this->status = $blog->status;

        $this->dispatchBrowserEvent('hide-confirmation-modal', ['message' => 'Status changed successfully!']);      
    }
}