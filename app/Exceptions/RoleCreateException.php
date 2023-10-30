<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RoleCreateException extends Exception
{
    public function render(Request $request)
    {
        smilify('error', 'Ruolo non inserito');

        return Redirect::route('roles.index');
    }
}
