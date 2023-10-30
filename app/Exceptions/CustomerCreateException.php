<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CustomerCreateException extends Exception
{
    public function render(Request $request)
    {
        smilify('error', 'Cliente non inserito');

        return Redirect::route('customers.index');
    }
}
