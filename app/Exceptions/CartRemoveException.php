<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CartRemoveException extends Exception
{
    public function render(Request $request)
    {
        smilify('error', 'Articolo non rimosso dal carrello');

        return Redirect::route('cart.index');
    }
}
