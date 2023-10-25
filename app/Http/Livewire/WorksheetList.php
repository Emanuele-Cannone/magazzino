<?php

namespace App\Http\Livewire;

use App\Models\Worksheet;
use Livewire\Component;
use Livewire\WithPagination;

class WorksheetList extends Component
{

    use WithPagination;

    public $perPage = 5;
    public $orderColumn = 'name';
    public $sortOrder = 'asc';
    public $sortLink = '<i class="fa-solid fa-caret-up"></i>';
    public $searchWorksheet = '';

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

        $worksheets = Worksheet::all();

//        $articles = Article::with(['stock', 'price'])->orderBy($this->orderColumn, $this->sortOrder);
//
//        if(!empty($this->searchWorksheet)){
//            $articles = Article::with(['stock', 'price', 'clusters'])
//                ->where('name','LIKE','%'.$this->searchWorksheet.'%')
//                ->orWhere('code','LIKE','%'.$this->searchWorksheet.'%')
//                ->orWherehas('clusters', function ($query) {
//                    return $query->where('name', 'LIKE', '%'.$this->searchWorksheet.'%');
//                })->orderBy($this->orderColumn, $this->sortOrder);
//
//        }
//
//        $worksheets = $worksheets->paginate($this->perPage);


        return view('worksheets.worksheet-list', ['worksheets' => $worksheets]);
    }
}
