<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use App\Models\Blog;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class BlogCreateComponent extends Component
{
    public $saveSuccess = false;
    public $state = [];
    use WithFileUploads;
    public $tags = [];
    
    public $selectedCategory = NULL;
    
         
    public function render()
    {
        $categories = Category::all();
                
        return view('livewire.blog-create-component',
        ['categories' => $categories,
         'subcategories' => SubCategory::where('category_id', $this->selectedCategory)->get()],
        );
    }

    public function mount(){
        $this->blog = new Blog;
        $this->category = Category::all();
        $this->subcategory = collect();
    }

    public function updatedSelectedCategory($category)
    {
        if (!is_null($category)) {
            $this->subcategory = SubCategory::where('category_id', $category)->get();
        }
    }

    public function createBlog(){

        $validatedData = Validator::make($this->state, [ 
            'title' => 'required|unique:blogs,title',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'short_description' => 'required',
            'note' => 'min:50',
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'required',
        ])->validate();
        $blog = new Blog();
        $blog->user_id = auth()->user()->id;
        $blog->title = $validatedData['title'];
        $blog->category_id = $validatedData['category_id'];
        $blog->sub_category_id = $validatedData['sub_category_id'];
        $blog->short_description = $validatedData['short_description'];
        $blog->body = $this->state['note'];
        $blog->image = $validatedData['image']->store('Blogs', 'public');
        $blog->slug = Str::slug($validatedData['title']);
        $blog->status = $this->state['status'] ?? '1';
        $blog->featured = $this->state['featured'] ?? '1';
        $tags = explode(",",$validatedData['tags']);
        $blog->save();

        if($blog) {
            foreach ($tags as $tag) {            
                $blog->tags()->create([
                    'name' => $tag,
                ]);
            }
            
            $this->filepath = Storage::url($blog->image);  
        }
       
        $url = route('admin.blogs');
        if($blog) {

            return Redirect::to($url)->with('message', 'Blog added successfully');;
        };
    }




}