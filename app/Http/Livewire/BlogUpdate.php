<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use App\Models\Blog;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BlogUpdate extends Component
{
    public $state = [];
    public $blog;
    public $categories;
    public $selectedCategory;
    public $subcategories;
    public $tags;
    
    public function mount(Blog $blog)  
    {
        $this->state = $blog->toArray();
        $this->categories = Category::all();
        $this->selectedCategory  = $this->blog->category_id;
        $this->selectedSubCategory  = $this->blog->sub_category_id;
        $this->tags = implode(',',$this->blog->tags->pluck('name')->toArray());
        $this->note = $this->blog->body;
        $this->loadSubcategories();
    }
     
    public function loadSubcategories()
    {
        $this->subcategories = Subcategory::where('category_id', $this->selectedCategory)->get();
    }
    
    public function render()
    {
        $blogs = Blog::all();
        $categories = Category::all();
        return view('livewire.blog-update',[
            'blogs' => $blogs,
            'categories' => $categories,
            'subcategories' => SubCategory::where('category_id', $this->selectedCategory)->get()
        ]);
    }

    public function updatedSelectedCategory()
    {
        $this->loadSubcategories();
    }

    public function updateBlog() 
    {
        $validatedData = Validator::make(
            [
                'title' => $this->state['title'],
                'category_id' => $this->state['category_id'],
                'sub_category_id' => $this->state['sub_category_id'],
                'short_description' => $this->state['short_description'],
                'note' => $this->note,
                'tags' => $this->tags,
            ],
            [ 
            'title' => 'required|unique:blogs,title,'.$this->blog->id,
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'short_description' => 'required',
            'note' => 'min:50',
            'tags' => 'required',
           ])->validate();
            
         // Add a validation rule to check the uniqueness of each tag
            $tagsArray = explode(',', $this->tags);
            foreach ($tagsArray as $tag) {
                $validationRules['tags.' . $tag] = Rule::unique('tags', 'name')->ignore($this->blog->id, 'blog_id');
            }
    
        $this->blog->title = $validatedData['title'];
        $this->blog->category_id = $validatedData['category_id'];
        $this->blog->sub_category_id = $validatedData['sub_category_id'];
        $this->blog->short_description = $validatedData['short_description'];
        $this->blog->body = $validatedData['note'];
        $this->blog->status = $this->state['status'] ?? '1';
        $this->blog->featured = $this->state['featured'] ?? '1';
        foreach ($tagsArray as $tag) {
            $existingTag = $this->blog->tags()->where('name', $tag)->first();
            if ($existingTag) {
                // Tag already exists, associate it with the blog post
                $this->blog->tags()->find($existingTag->id);
            } else {
                // Tag doesn't exist, create and associate it with the blog post
                $newTag = $this->blog->tags()->create(['name' => $tag]);
                $this->blog->tags()->find($newTag->id);
            }
        }
        
        if($this->state['image'] !=  $this->blog->image) {
            Storage::disk('public')->delete($this->blog->image);
            $this->blog->image =  $this->state['image']->store('Categories', 'public');
        }   
        
        $blog = $this->blog->save();
        
        $url = route('admin.blogs');
        if($blog) {

            return Redirect::to($url)->with('message', 'Blog updated successfully');;
        };
   
    }

}