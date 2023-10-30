<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AppointmentUpdateException extends Exception
{
    public function render(Request $request)
    {
        smilify('error', 'Appuntamento non aggiornato');

        return Redirect::route('appointments.index');
    }
}
