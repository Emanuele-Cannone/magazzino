<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleList extends Component
{

    use WithPagination;

    public $perPage = 5;
    public $orderColumn = 'name';

    public $sortOrder = 'asc';

    public $sortLink = '<i class="fa-solid fa-caret-up"></i>';
    public $searchRole = '';

    public function loadMore()
    {
        $this->perPage += 5;
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function sortOrder($columnName = '')
    {
        $caretorder = 'up';
        if($this->sortOrder == 'asc'){
            $this->sortOrder = 'desc';
            $caretorder = 'down';
        } else {
            $this->sortOrder = 'asc';
            $caretorder = 'up';
        }
        $this->sortLink = '<i class="fa-solid fa-caret-'.$caretorder.'"></i>';
        $this->orderColumn = $columnName;

    }

    public function render()
    {
        $roles = Role::orderBy($this->orderColumn, $this->sortOrder);

        if(!empty($this->searchRole)){
            $roles = Role::where('name','LIKE','%'.$this->searchRole.'%')
                ->orderBy($this->orderColumn, $this->sortOrder);

        }

        $roles = $roles->paginate($this->perPage);

        return view('roles.role-list', ['roles' => $roles]);
    }
}
