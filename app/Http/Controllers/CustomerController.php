<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->customerService = new CustomerService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::paginate();

        return view('customers.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request): RedirectResponse
    {

        $this->customerService->create($request);

        return Redirect::route('customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $this->customerService->update($request, $customer->id);

        return Redirect::route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer = Customer::findOrFail($customer->id);

        $customer->delete();

        smilify('success', 'Cliente eliminato con successo');

        return Redirect::route('customers.index');
    }
}
