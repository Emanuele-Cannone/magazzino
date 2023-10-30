<?php

namespace App\Http\Livewire;

use App\Models\ForcedAction;
use Livewire\Component;
use Livewire\WithPagination;

class ActionList extends Component
{

    use WithPagination;

    public $perPage = 5;
    public $orderColumn = 'created_at';
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
        $actions = ForcedAction::with(['user'])->orderBy($this->orderColumn, $this->sortOrder);

        if(!empty($this->searchUser)){
            $actions = ForcedAction::with(['user'])
                ->whereHas('user', function ($query) {
                    return $query->where('name', 'LIKE', '%'.$this->searchUser.'%');
                })
                ->orderBy($this->orderColumn, $this->sortOrder);
        }

        $actions = $actions->paginate($this->perPage);

        return view('actions.action-list', ['actions' => $actions]);
    }
}
