<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class RoleUserForm extends Component
{

    public $roles;

    public $user;

    public $roleExists;


    public function render()
    {
        return view('users.role-user-form',
            [
                'roles' => $this->roles,
                'roleExists' => $this->roleExists
            ]
        );
    }

}
