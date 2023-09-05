<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SubAdmin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class SubAdminComponent extends Component
{
    public $state = [];
    public $showEditModal = false;
    public $subadmin;
    public $subadminIdBeingRemoved = null;
    public $permission = []; 
  

       
    public function render()
    {
        $subadmins = SubAdmin::latest()->get();
        $subadminRole = Role::findByName('Sub Admin');
        $permissions = $subadminRole->permissions;
        
        return view('livewire.sub-admin-component', [
            'subadmins' => $subadmins,
            'permissions' => $permissions
        ]);
    }
                                                                                                                                                                     
    public function addNew()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');   
    }

    public function edit(SubAdmin $subadmin)
    {
        dd($subadmin);
        $this->showEditModal = true;
        $this->subadmin = $subadmin;
        $this->state = $subadmin->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function createSubadmin() {
       
        $validatedData = Validator::make($this->state, [ 
        'name' => 'required',
        'email' => 'required|email|unique:sub_admins',
        'password' => 'required|confirmed',
        'permission.*' => 'required'
       ])->validate();

       $subadmin = new SubAdmin();
       $subadmin->name = $validatedData['name'];
       $subadmin->email = $validatedData['email'];
       $subadmin->password = $validatedData['password'];
       $subadmin->save();
            
        
        $subadminRole = Role::findByName('Sub Admin');
        $permissions = $subadminRole->permissions;
        
        $role = $subadmin->assignRole($subadminRole->name);
        dd($role);
        $permission = $role->givePermissionTo($validatedData['permission']);
        dd($role,$permission);
        
    //    $subadminRole = Role::findByName('Sub Admin'); 
    //    dd($permission);
    
       //    $subadmin->syncPermissions($validatedData['permission']);
    
        if($subadmin) {
            $this->dispatchBrowserEvent('hide-form', ['message' => 'Sub admin added successfully!']);
        }
    }

    public function updateSubadmin() {
       
        $validatedData = Validator::make($this->state, [ 
        'name' => 'required',
        'email' => 'required|email|unique:sub_admins,email,'.$this->subadmin->id,
        'password' => 'sometimes|confirmed',
       ])->validate();
   
       
        // $subadmin = $this->subadmin->update($validatedData);
        
        $this->subadmin->name = $validatedData['name'];
        $this->subadmin->email =  $validatedData['name'];
        $this->subadmin->password = $validatedData['password'];
            
        $subadmin = $this->subadmin->save();           
        if($subadmin) {
            $this->dispatchBrowserEvent('hide-form', ['message' => 'Sub Admin updated successfully!']); 
        }           
    }

     //confirm Sub admin removal component
     public function confirmSubadminRemoval($subadminId) {
     
        $this->subadminIdBeingRemoved = $subadminId;
        $this->dispatchBrowserEvent('show-delete-modal');
        
    }

    //delete subadmin
    public function deleteSubadmin() {
    
        $subadmin = SubAdmin::findOrFail($this->subadminIdBeingRemoved);
        $subadmin->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Sub admin deleted successfully!']);        
    }
}