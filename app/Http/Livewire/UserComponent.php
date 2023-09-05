<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;


class UserComponent extends Component
{
    // use HasRoles;
    public $state = [];
    public $showEditModal = false;
    public $user,$userRole;
    public $userIdBeingRemoved = null;
    public $updateMode = false;
    
    public function render()
    {
        $users = User::latest()->paginate(5);
        $roles = Role::latest()->get();
        return view('livewire.user-component', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function addNew()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->roles = Role::latest()->get();
        $this->dispatchBrowserEvent('show-form');   
    }

    public function edit(User $user)
    {
        $this->showEditModal = true;
        $this->user = $user;
        $this->state = $user->toArray();
        $this->userRole = $user->roles->pluck('name', 'name')->first();
        $this->state['roles'] = $this->userRole;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createUser() {
       
        $validatedData = Validator::make($this->state, [ 
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed',
        'roles' => 'required'
       ])->validate();
   
       $user = new User();
       $user->name = $validatedData['name'];
       $user->email = $validatedData['email'];
       $user->password = $validatedData['password'];
       $user->status = $this->state['status'] ?? '1';

       $role = Role::where('name',$validatedData['roles'])->first();
       $user->assignRole($role);
       $user->save();
    
        if($user) {
            $this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
        }
    }

    public function updateUser() {
       
      
        $validatedData = Validator::make($this->state, [ 
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$this->user->id,
        'password' => 'nullable|confirmed',
        'roles' => 'required'
       ])->validate();       
        // $user = $this->user->update($validatedData);
        
        $this->user->name = $validatedData['name'];
        $this->user->email =  $validatedData['email'];
        $this->user->status = $this->state['status'];
        if (!empty($validatedData['password'])) {
            $this->user->password = $validatedData['password'];
        }   
                
        $newRole = Role::findByName($validatedData['roles']);
    
        $oldRole = $this->user->roles->first();
        if ($oldRole) {
            $this->user->removeRole($oldRole);
        }
    
        $this->user->assignRole($newRole);
    
        $user = $this->user->save();           
        if($user) {
            $this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']); 
        }           
    }

     //confirm user removal component
     public function confirmUserRemoval($userId) {
     
        $this->userIdBeingRemoved = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
        
    }

    //delete User
    public function deleteUser() {
    
        $user = User::findOrFail($this->userIdBeingRemoved);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'User deleted successfully!']);        
    }

}