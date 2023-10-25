<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ArticleUpdateException extends Exception
{
    public function render(Request $request)
    {
        smilify('error', 'Articolo non aggiornato');

        return Redirect::route('articles.index');
    }
}
