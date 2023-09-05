<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;


class RoleComponent extends Component
{
    public $name, $permission_id;
    public $updateMode = false;
    public $state = [ 'permission_id' => [], 'name'];
    public $showEditModal = false;
    public $rolePermissions; 
    
    public function render()
    {
        $roles = Role::latest()->get();
        $permissions = Permission::all();
        return view('livewire.role',
        [
            'roles' => $roles,
            'permissions' => $permissions
        ]);
        
    }

    public function addNew()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->permissions = Permission::all();
        $this->dispatchBrowserEvent('show-form');   
    }

    public function edit(Role $role)
    {
        $this->showEditModal = true;
        $this->role = $role;
        $this->state = $role->toArray();
        $this->rolePermissions = $role->permissions->pluck('name')->toArray();
       
        
        // dd($this->rolePermissions);
        $this->dispatchBrowserEvent('show-form');
    }

    public function createRole(Request $request) {
       
        $validatedData = Validator::make($this->state, [ 
        'name' => 'required|unique:roles,name',
        'permission_id' => 'required',
       ])->validate();
   
       $role = Role::create($validatedData);
       $role->syncPermissions($this->state['permission_id']);
       
        if($role) {
            $this->dispatchBrowserEvent('hide-form', ['message' => 'Role added successfully!']);
        }
    }

    public function updateRole(Request $request,Role $role) {
       
        
        $validatedData = Validator::make($this->state, [ 
            'name' => 'required|unique:roles,name,'.$this->role->id,
            'permission_id' => 'required'
           ])->validate();
 
        
           $role = $this->role->update($validatedData);
           $role =  $this->role->syncPermissions($this->state['permission_id']);
        
        if($role) {
            $this->dispatchBrowserEvent('hide-form', ['message' => 'Permission updated successfully!']); 
        }           
    }

     //confirm user removal component
     public function confirmRoleRemoval($roleId) {
     
        $this->roleIdBeingRemoved = $roleId;
        $this->dispatchBrowserEvent('show-delete-modal');
        
    }

    //delete User
    public function deleteRole() {
     
        $role = Role::findOrFail($this->roleIdBeingRemoved);
        $role->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Role deleted successfully!']);        
    }

}