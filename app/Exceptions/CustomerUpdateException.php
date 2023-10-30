<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CustomerUpdateException extends Exception
{
    public function render(Request $request)
    {
        smilify('error', 'Cliente non aggiornato');

        return Redirect::route('customers.index');
    }
}
