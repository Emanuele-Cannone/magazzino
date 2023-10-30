<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderList extends Component
{

    use WithPagination;

    public $perPage = 5;
    public $orderColumn = 'created_at';
    public $sortOrder = 'desc';
    public $sortLink = '<i class="fa-solid fa-caret-up"></i>';
    public $searchOrder = '';

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
        $orders = Order::with(['customer'])->orderBy($this->orderColumn, $this->sortOrder);

        if(!empty($this->searchOrder)){
            $orders = Order::with(['customer'])
                ->whereHas('customer', function ($query) {
                    return $query->where('name', 'LIKE', '%'.$this->searchOrder.'%');
                })
                ->orderBy($this->orderColumn, $this->sortOrder);
        }

        $orders = $orders->paginate($this->perPage);

        return view('orders.order-list', ['orders' => $orders]);
    }
}
