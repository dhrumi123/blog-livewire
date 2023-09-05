<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryComponent extends Component
{
    public $name,$image,$filepath = "";
    public $updateMode = false;
    public $state = [];
    public $showEditModal = false;
    public $editingImage;
    
    use WithFileUploads;
    
    public function render()
    {
        $categories = Category::latest()->get();
        
        return view('livewire.category-component',
        [
            'categories' => $categories,
        ]);
        
    }

    public function addNew()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');   
    }

    public function edit(Category $category)
    {
        
        $this->showEditModal = true;
        $this->category = $category;
        $this->state = $category->toArray();
        $this->editingImage = $category->image;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createCategory() {
       
        $validatedData = Validator::make($this->state, [ 
        'name' => 'required|unique:categories,name',
        'image'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
       ])->validate();
   
        
        $category = new Category();
        $category->name = $validatedData['name'];
        $category->image = $validatedData['image']->store('Categories', 'public');
        $category->slug = Str::slug($validatedData['name']);
        $category->status = $this->state['status'] ?? '1';
     

        $category->save();

        $this->filepath = Storage::url($category->image);
        
        if($category) {
            $this->dispatchBrowserEvent('hide-form', ['message' => 'Category added successfully!']);
        }
    }

    public function updateCategory(Category $category) {
       
        $validatedData = Validator::make($this->state, [ 
            'name' => 'required|unique:categories,name,'.$this->category->id
           ])->validate();
            
       
        // $category = $this->category->update($validatedData);
    
        $this->category->name = $validatedData['name'];
        $this->category->slug = Str::slug($validatedData['name']);
        $this->category->status = $this->state['status'];
                
        if($this->state['image'] !=  $this->category->image) {
            Storage::disk('public')->delete($this->category->image);
            $this->category->image =  $this->state['image']->store('Categories', 'public');
        } 

        $category = $this->category->save();
        
        if($category) {
            $this->dispatchBrowserEvent('hide-form', ['message' => 'Category updated successfully!']); 
        }           
    }

      //confirm user removal component
      public function confirmcategoryRemoval($categoryId) {
     
        $this->categoryIdBeingRemoved = $categoryId;
        $this->dispatchBrowserEvent('show-delete-modal');
        
    }

    //delete User
    public function deleteCategory() {
     
        $category = Category::findOrFail($this->categoryIdBeingRemoved);
        $category->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Category deleted successfully!']);        
    }
}