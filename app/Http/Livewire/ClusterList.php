<?php

namespace App\Http\Livewire;

use App\Models\Cluster;
use Livewire\Component;
use Livewire\WithPagination;

class ClusterList extends Component
{

    use WithPagination;

    public $perPage = 5;
    public $orderColumn = 'name';
    public $sortOrder = 'asc';
    public $sortLink = '<i class="fa-solid fa-caret-up"></i>';
    public $searchCluster = '';

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
        if ($this->sortOrder == 'asc') {
            $this->sortOrder = 'desc';
            $caretorder = 'down';
        } else {
            $this->sortOrder = 'asc';
            $caretorder = 'up';
        }
        $this->sortLink = '<i class="fa-solid fa-caret-' . $caretorder . '"></i>';
        $this->orderColumn = $columnName;

    }

    public function render()
    {
        $clusters = Cluster::orderBy($this->orderColumn, $this->sortOrder);

        if(!empty($this->searchCluster)){
            $clusters = Cluster::where('name','LIKE','%'.$this->searchCluster.'%')
                ->orderBy($this->orderColumn, $this->sortOrder);

        }

        $clusters = $clusters->paginate($this->perPage);

        return view('clusters.cluster-list', [
            'clusters' => $clusters
        ]);
    }
}
