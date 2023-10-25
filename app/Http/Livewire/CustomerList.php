<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerList extends Component
{

    use WithPagination;

    public $perPage = 5;
    public $orderColumn = 'name';
    public $sortOrder = 'asc';
    public $sortLink = '<i class="fa-solid fa-caret-up"></i>';
    public $searchCustomer = '';

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
        $customers = Customer::orderBy($this->orderColumn, $this->sortOrder);

        if(!empty($this->searchCustomer)){
            $customers = Customer::where('name','LIKE','%'.$this->searchCustomer.'%')
                    ->orWhere('email','LIKE','%'.$this->searchCustomer.'%')
                    ->orderBy($this->orderColumn, $this->sortOrder);

        }

        $customers = $customers->paginate($this->perPage);

        return view('customers.customer-list', [
            'customers' => $customers
        ]);
    }
}
