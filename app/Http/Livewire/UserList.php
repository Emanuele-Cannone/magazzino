<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{

    use WithPagination;

    public $perPage = 5;
    public $orderColumn = 'name';
    public $sortOrder = 'asc';
    public $sortLink = '<i class="fa-solid fa-caret-up"></i>';
    public $searchUser = '';

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
        $users = User::orderBy($this->orderColumn, $this->sortOrder);

        if(!empty($this->searchUser)){
            $users = User::with(['roles'])
                    ->where('name','LIKE','%'.$this->searchUser.'%')
                    ->orWhere('email','LIKE','%'.$this->searchUser.'%')
                    ->orderBy($this->orderColumn, $this->sortOrder);

        }

        $users = $users->paginate($this->perPage);

        return view('users.user-list', [
            'users' => $users
        ]);
    }
}
