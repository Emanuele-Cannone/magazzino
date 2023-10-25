<?php

namespace App\Services;

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

            smilify('success', 'You are successfully reconnected');

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('articolo non inserito', [$e->getMessage()]);
//            throw new ArticleCreateException();
        }
    }

    public function update(ClusterUpdateRequest $request, string $id): void
    {
        try {
            DB::beginTransaction();

            $cluster = Cluster::findOrFail($id);

            $cluster->update($request->all());

            smilify('success', 'You are successfully reconnected');

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('articolo non inserito', [$e->getMessage()]);
//            throw new ArticleCreateException();
        }
    }
    public function delete(string $id): void
    {
        try {
            DB::beginTransaction();

            $cluster = Cluster::findOrFail($id);

            $cluster->delete();

            smilify('success', 'You are successfully reconnected');

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('articolo non inserito', [$e->getMessage()]);
//            throw new ArticleCreateException();
        }
    }
}
