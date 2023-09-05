<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;

class BlogComponent extends Component
{
    public $state = [];
    public $updateBlog = false;
    
    public function render()
    {
        $blogs = Blog::latest()->get();
       
        return view('livewire.blog-component',
        [
            'blogs' => $blogs
        ]);
    }
    
    public function changeStatus() {
        dd('ok');
    }

    public function edit(Blog $blog) {

        $this->blog = $blog;
        $this->state = $blog->toArray();    
        $this->updateBlog = true;        
    }
 
    public function updateBlog(Blog $blog) {
       
        $validatedData = Validator::make($this->state, [ 
            'title' => 'required|unique:blogs,title,'.$this->blog->id,
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'note' => 'min:50',
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'required',
        ])->validate();
   
        $this->blog->title = $validatedData['title'];
        $this->blog->category_id = $validatedData['category_id'];
        $this->blog->sub_category_id = $validatedData['sub_category_id'];
        $this->blog->note = $this->state['note'];
        $this->blog->status = $this->state['status'];
        $this->blog->status = $this->state['status'] ?? '1';
        $this->blog->featured = $this->state['featured'] ?? '1';
        $tags = explode(",",$validatedData['tags']);
        
        $blog = $this->blog->save();
        
        if($blog) {
            $this->dispatchBrowserEvent('hide-form', ['message' => 'Sub Category updated successfully!']); 
        }           
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
}