<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ArticleAddToStockException extends Exception
{
    public function render(Request $request)
    {
        smilify('error', 'Articolo non inserito in stock');

        return Redirect::route('articles.index');
    }
}
