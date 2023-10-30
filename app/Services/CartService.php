<?php

namespace App\Services;

use App\Exceptions\ArticleUpdateException;
use App\Exceptions\CartRemoveException;
use App\Exceptions\QuantityExceedException;
use App\Http\Requests\CartStoreRequest;
use App\Models\Article;
use App\Models\ArticleStock;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Throwable;

class CartService
{
    /**
     * @throws ContainerExceptionInterface
     * @throws Throwable
     * @throws NotFoundExceptionInterface
     */
    public function store(CartStoreRequest $cartStoreRequest){

        $quantity = intval($cartStoreRequest->get('quantity'));

        $article = Article::with(['stock'])->firstOrfail();

        /** @var Collection $cartSession */
        $cartSession = session()->get('cart');

        /** @var Collection $sameArticle */
        $sameArticle = $cartSession->get($cartStoreRequest->articleId);

        if($sameArticle){
            $quantity += $sameArticle->get('quantity');
        }

        $cartData = collect(['quantity' => $quantity]);

        throw_if($quantity > $article->stock->current_stock, QuantityExceedException::class);

        $cartSession->put(
            $cartStoreRequest->articleId,
            $cartData
        );

        smilify('success', 'Articolo aggiunto al carrello');

    }

    public function cartResolve()
    {
        $cartData = session()->get('cart');

        $articles = Article::with(['price'])->get()->toBase();

        return $cartData->mapWithKeys(function ($data, $key) use ($articles) {
            $mainCartData = collect(
                [
                    'article' => $articles->firstWhere('id', $key),
                    'price' => ($articles->firstWhere('id', $key)->price->price * $data['quantity']),
                    'quantity' => $data['quantity']
                ]
            );
           return collect([$key => $mainCartData]);
        });
    }

    public function removeFromCart(string $idx)
    {
        try {
            DB::beginTransaction();

            $idx === 0 ? session()->put('cart', collect()) : session()->get('cart')->forget($idx);

            smilify('success', 'Articolo rimosso dal carrello');

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('articolo non rimosso dal carrello', [$e->getMessage()]);
            throw new CartRemoveException();
        }

    }
}
