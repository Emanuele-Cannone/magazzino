<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ClusterCreateException extends Exception
{
    public function render(Request $request)
    {
        smilify('error', 'Gruppo non inserito');

        return Redirect::route('clusters.index');
    }
}
