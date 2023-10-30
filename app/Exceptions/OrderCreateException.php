<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrderCreateException extends Exception
{
    public function render(Request $request)
    {
        smilify('error', 'Ordine non inserito');

        return Redirect::route('orders.index');
    }
}
