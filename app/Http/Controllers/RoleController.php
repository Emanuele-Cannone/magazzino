<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->service = new RoleService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('roles.index', ['roles' => Role::all()]);
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
    public function store(RoleStoreRequest $request)
    {
        $this->service->create($request);

        return Redirect::route('roles.index');
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
        return view('roles.edit', ['role' => Role::findOrFail($id), 'permissions' => Permission::orderBy('name')->get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request)
    {
        $this->service->update($request);

        return Redirect::route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findById($id, 'web');

        $role->delete();

        return Redirect::route('roles.index');
    }
}
