<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserCreateException extends Exception
{
    public function render(Request $request)
    {
        smilify('error', 'Utente non inserito');

        return Redirect::route('users.index');
    }
}
