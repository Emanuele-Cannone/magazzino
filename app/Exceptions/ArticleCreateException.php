<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class ArticleCreateException extends Exception
{
    public function render(Request $request)
    {
        smilify('error', 'Articolo non creato');

        return Redirect::route('articles.index');
    }
}
