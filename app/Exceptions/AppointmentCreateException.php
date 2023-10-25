<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AppointmentCreateException extends Exception
{
    public function render(Request $request)
    {
        smilify('error', 'Appuntamento non inserito');

        return Redirect::route('appointments.index');
    }
}
