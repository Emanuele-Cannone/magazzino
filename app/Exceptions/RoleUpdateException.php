<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RoleUpdateException extends Exception
{
    public function render(Request $request)
    {
        smilify('error', 'Ruolo non aggiornato');

        return Redirect::route('roles.index');
    }
}
