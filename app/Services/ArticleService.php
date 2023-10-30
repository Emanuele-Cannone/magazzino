<?php

namespace App\Services;


use App\Exceptions\ArticleAddToStockException;
use App\Exceptions\ArticleCreateException;
use App\Exceptions\ArticleUpdateException;
use App\Http\Requests\ArticleRefillRequest;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\ForcedAction;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ArticleService
{
    public function create(ArticleStoreRequest $request): void
    {

        try {
            DB::beginTransaction();

            $newArticle = Article::create(
                [
                    'name' => $request->name,
                    'code' => $request->code,
                    'description' => $request->description
                ]);

            $newArticle->stock()->create([
                'min_stock' => $request->min_quantity,
                'current_stock' => $request->quantity
            ]);

            $newArticle->price()->create([
                'price' => $request->price
            ]);

            $clusters = collect(json_decode($request->clusters))->map(fn ($cluster) => $cluster->id)->toArray();

            $newArticle->clusters()->sync($clusters);

            ForcedAction::create([
                'user_id' => Auth::id(),
                'action' => 'creato articolo: '.$request->name.' - min_quantity: '.$request->min_quantity.' - stock: '.$request->quantity.' - prezzo: '.$request->price
            ]);

            smilify('success', 'Articolo creato correttamente');
            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('articolo non creato', [$e->getMessage()]);
            throw new ArticleCreateException();
        }
    }

    public function update(ArticleUpdateRequest $request, string $id): void
    {
        try {
            DB::beginTransaction();

            $article = Article::findOrFail($id);

            $article->update([
                    'name' => $request->name,
                    'code' => $request->code,
                    'description' => $request->description
                ]);

            $article->stock->update([
                'min_stock' => $request->min_quantity,
                'current_stock' => $request->quantity
            ]);

            $article->price->update([
                'price' => $request->price
            ]);

            $clusters = collect(json_decode($request->clusters))->map(fn ($cluster) => $cluster->id)->toArray();

            $article->clusters()->sync($clusters);

            ForcedAction::create([
                'user_id' => Auth::id(),
                'action' => 'modificato articolo: '.$request->name.' - min_quantity: '.$request->min_quantity.' - stock: '.$request->quantity.' - prezzo: '.$request->price
            ]);

            smilify('success', 'Articolo aggiornato');
            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('articolo non aggiornato', [$e->getMessage()]);
            throw new ArticleUpdateException();
        }
    }

    public function addToStock(ArticleRefillRequest $request, Article $article)
    {

        try {
            DB::beginTransaction();

            $article->stock->increment('current_stock', $request->quantity);

            $article->price->update([
                    'price' => $request->price
                ]);

            ForcedAction::create([
                'user_id' => Auth::id(),
                'action' => 'refill articolo: '.$article->name.' - quantity: '.$request->quantity.' - prezzo: '.$request->price
            ]);

            smilify('success', 'Articolo aggiunto nello stock');

            DB::commit();
        } catch (Exception $e) {

            DB::rollBack();
            Log::error('articolo non aggiunto allo stock', [$e->getMessage()]);
            throw new ArticleAddToStockException();
        }
    }
}
