<?php

namespace App\Services;

use App\Exceptions\RoleCreateException;
use App\Exceptions\RoleUpdateException;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleService
{

    public function create(RoleStoreRequest $request): void
    {

        try {
            DB::beginTransaction();

            Role::create([
                'name' => $request->name,
                'guard_name' => 'web'
            ]);

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('Ruolo non creato', [$e->getMessage()]);
            throw new RoleCreateException();
        }
    }

    public function update(RoleUpdateRequest $request): void
    {

        try {
            DB::beginTransaction();

            $role = Role::findByName($request->name, 'web');

            $role->syncPermissions($request->permissions);

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('Permesso non assegnato', [$e->getMessage()]);
            throw new RoleUpdateException();
        }
    }
}

