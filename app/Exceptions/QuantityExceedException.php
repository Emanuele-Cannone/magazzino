<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class QuantityExceedException extends Exception
{
    public function render(Request $request)
    {
        smilify('error', 'Quantità non disponibile');

        return Redirect::route('articles.index');
    }
}
