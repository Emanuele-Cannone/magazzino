<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ClusterRemoveException extends Exception
{
    public function render(Request $request)
    {
        smilify('error', 'Gruppo non eliminato');

        return Redirect::route('clusters.index');
    }
}
