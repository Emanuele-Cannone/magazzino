<?php

namespace App\Services;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Article;
use App\Models\ArticleStock;
use App\Models\Order;
use App\Models\OrderArticle;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
    public function create(OrderStoreRequest $request): void
    {

        try {
            DB::beginTransaction();

            $newOrder = Order::create($request->all());

            $cartData = session()->get('cart');

            $cartData->map(function ($key, $article) use ($newOrder) {
                return [
                    OrderArticle::create([
                        'order_id' => $newOrder->id,
                        'article_id' => $article,
                        'quantity' => $key['quantity'],
                        'price' => Article::findOrFail($article)->price->price * $key['quantity']
                    ]),
                    ArticleStock::where('article_id', $article)->decrement('current_stock', $key['quantity'])
                ];
            });

            $newOrder->customers()->sync($request->customer_id);

            session()->put('cart', collect());

            smilify('success', 'You are successfully reconnected');

            DB::commit();
        } catch (Exception $e) {

            DB::rollBack();
            Log::error('articolo non inserito', [$e->getMessage()]);
//            throw new ArticleCreateException();
        }
    }

}
