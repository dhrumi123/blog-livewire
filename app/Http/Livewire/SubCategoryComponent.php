<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class SubCategoryComponent extends Component
{
    
    public $name;
    public $updateMode = false;
    public $state = [];
    public $showEditModal = false;
        
    public function render()
    {
        $subcategories = SubCategory::latest()->paginate(5);
        $categories = Category::all();
        
        return view('livewire.sub-category-component',
        [
            'subcategories' => $subcategories,
            'categories' => $categories
        ]);
        
    }

    public function addNew()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->categories = Category::all();
        $this->dispatchBrowserEvent('show-form');   
    }

    public function edit(SubCategory $subcategory)
    {
        
        $this->showEditModal = true;
        $this->subcategory = $subcategory;
        $this->state = $subcategory->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function createSubCategory() {
    //    dd($this->state);
        $validatedData = Validator::make($this->state, [ 
        'name' => 'required|unique:sub_categories,name',
        'category_id' => 'required'
       ])->validate();
            
    //    $category = Category::create($validatedData);

        $subcategory = new SubCategory();
        $subcategory->name = $validatedData['name'];
        $subcategory->category_id = $validatedData['category_id'];
        $subcategory->slug = Str::slug($validatedData['name']);
        $subcategory->status = $this->state['status'] ?? '1';

        $subcategory->save();
    
        if($subcategory) {
            $this->dispatchBrowserEvent('hide-form', ['message' => 'Sub Category added successfully!']);
        }
    }

    public function updateSubCategory(SubCategory $subcategory) {
       
        $validatedData = Validator::make($this->state, [ 
            'name' => 'required|unique:sub_categories,name,'.$this->subcategory->id,
            'category_id' => 'required'
        ])->validate();
   
        $this->subcategory->name = $validatedData['name'];
        $this->subcategory->category_id = $validatedData['category_id'];
        $this->subcategory->slug = Str::slug($validatedData['name']);
        $this->subcategory->status = $this->state['status'];
        $subcategory = $this->subcategory->save();
       
            // $subcategory = $this->subcategory->update($validatedData);
        
        if($subcategory) {
            $this->dispatchBrowserEvent('hide-form', ['message' => 'Sub Category updated successfully!']); 
        }           
    }

      //confirm user removal component
      public function confirmsubcategoryRemoval($subcategoryId) {
     
        $this->subcategoryIdBeingRemoved = $subcategoryId;
        $this->dispatchBrowserEvent('show-delete-modal');
        
    }

    //delete User
    public function deleteCategory() {
     
        $subcategory = SubCategory::findOrFail($this->subcategoryIdBeingRemoved);
        $subcategory->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Sub Category deleted successfully!']);        
    }
}