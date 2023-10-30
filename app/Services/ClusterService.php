<?php

namespace App\Services;

use App\Exceptions\ClusterCreateException;
use App\Exceptions\ClusterRemoveException;
use App\Exceptions\ClusterUpdateException;
use App\Http\Requests\ClusterStoreRequest;
use App\Http\Requests\ClusterUpdateRequest;
use App\Models\Cluster;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClusterService
{
    public function create(ClusterStoreRequest $request): void
    {

        try {
            DB::beginTransaction();

            Cluster::create($request->all());

            smilify('success', 'Gruppo creato correttamente');

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('gruppo non creato', [$e->getMessage()]);
            throw new ClusterCreateException();
        }
    }

    public function update(ClusterUpdateRequest $request, string $id): void
    {
        try {
            DB::beginTransaction();

            $cluster = Cluster::findOrFail($id);

            $cluster->update($request->all());

            smilify('success', 'Gruppo modificato correttamente');

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('gruppo non modificato', [$e->getMessage()]);
            throw new ClusterUpdateException();
        }
    }
    public function delete(string $id): void
    {
        try {
            DB::beginTransaction();

            $cluster = Cluster::findOrFail($id);

            $cluster->delete();

            smilify('success', 'Gruppo eliminato correttamente');

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('gruppo non eliminato', [$e->getMessage()]);
            throw new ClusterRemoveException();
        }
    }
}
