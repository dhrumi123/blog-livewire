<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Support\ServiceProvider;


class PermissionComponent extends Component
{
    public $name;
    public $updateMode = false;
    public $state = [];
    public $showEditModal = false;

    public function render()
    {
        $permissions = Permission::latest()->paginate(5);
        return view('livewire.permission',
        [
            'permissions' => $permissions,
        ]);
        
    }

    public function addNew()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');   
    }

    public function edit(Permission $permission)
    {
        
        $this->showEditModal = true;
        $this->permission = $permission;
        $this->state = $permission->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function createPermission() {
       
        $validatedData = Validator::make($this->state, [ 
        'name' => 'required|unique:permissions,name',
       ])->validate();
   
       $permission = Permission::create($validatedData);
    
        if($permission) {
            $this->dispatchBrowserEvent('hide-form', ['message' => 'Permission added successfully!']);
        }
    }

    public function updatePermission(Permission $permission) {
       
        $validatedData = Validator::make($this->state, [ 
            'name' => 'required|unique:permissions,name,'.$this->permission->id,
           ])->validate();
   
       
        $permission = $this->permission->update($validatedData);
    
        if($permission) {
            $this->dispatchBrowserEvent('hide-form', ['message' => 'Permission updated successfully!']); 
        }           
    }

      //confirm user removal component
      public function confirmpermissionRemoval($permissionId) {
     
        $this->permissionIdBeingRemoved = $permissionId;
        $this->dispatchBrowserEvent('show-delete-modal');
        
    }

    //delete User
    public function deletePermission() {
     
        $permission = Permission::findOrFail($this->permissionIdBeingRemoved);
        $permission->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Role deleted successfully!']);        
    }

}