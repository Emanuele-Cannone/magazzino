<?php

namespace App\Services;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{

    public function create(UserStoreRequest $request): void
    {

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(trim($request->name).$request->email)
            ]);

            $user->assignRole('Guest');

            smilify('success', 'Cliente inserito correttamente');
            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('cliente non inserito', [$e->getMessage()]);
//            throw new ArticleCreateException();
        }
    }

//    public function update(CustomerUpdateRequest $request, string $id): void
//    {
//
//        try {
//            DB::beginTransaction();
//
//            $customer = Customer::findOrFail($id);
//
//            $customer->update($request->all());
//
//            smilify('success', 'Cliente modificato correttamente');
//
//            DB::commit();
//
//        } catch (Exception $e) {
//
//            DB::rollBack();
//            Log::error('cliente non modificato', [$e->getMessage()]);
////            throw new ArticleCreateException();
//        }
//    }
}

