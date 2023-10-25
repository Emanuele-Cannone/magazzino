<?php

namespace App\Services;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerService
{
    public function create(CustomerStoreRequest $request): void
    {

        try {
            DB::beginTransaction();

            Customer::create($request->all());

            smilify('success', 'Cliente inserito correttamente');
            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('cliente non inserito', [$e->getMessage()]);
//            throw new ArticleCreateException();
        }
    }

    public function update(CustomerUpdateRequest $request, string $id): void
    {

        try {
            DB::beginTransaction();

            $customer = Customer::findOrFail($id);

            $customer->update($request->all());

            smilify('success', 'Cliente modificato correttamente');

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('cliente non modificato', [$e->getMessage()]);
//            throw new ArticleCreateException();
        }
    }
}

