<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClusterStoreRequest;
use App\Http\Requests\ClusterUpdateRequest;
use App\Models\Cluster;
use App\Services\ClusterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ClusterController extends Controller
{

    public function __construct()
    {
        $this->clusterService = new ClusterService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('clusters.index', ['clusters' => Cluster::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clusters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClusterStoreRequest $request)
    {
        $this->clusterService->create($request);

        return Redirect::route('clusters.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('clusters.edit', ['cluster' => Cluster::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClusterUpdateRequest $request, string $id)
    {
        $this->clusterService->update($request, $id);

        return Redirect::route('clusters.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->clusterService->delete($id);

        return Redirect::route('clusters.index');
    }
}
