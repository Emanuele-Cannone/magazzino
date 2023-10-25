<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->service = new UserService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index',  ['users' => User::all()]);
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
    public function store(UserStoreRequest $request)
    {
        $this->service->create($request);

        return Redirect::route('users.index');
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
        $user = User::findOrFail($id);

        $roles = Role::all();

        return view('users.edit', [
            'user' => $user,
            'roles' => $roles,
            'roleExists' => $user->getRoleNames()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        smilify('success', 'Utente eliminato correttamente');

        return Redirect::route('users.index');
    }

    public function syncRoles(Request $request, User $user)
    {

        $roleAssign = collect(json_decode($request['roles']))->map(fn ($role) => $role->value)->toArray();

        $user = User::findOrFail($user->id);

        $user->syncRoles($roleAssign);

        smilify('success', 'Ruolo aggiornato correttamente');

        return Redirect::route('users.index');
    }
}
