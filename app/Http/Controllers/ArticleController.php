<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRefillRequest;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\Cluster;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->articleService = new ArticleService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('articles.index', ['articles' => Article::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'article' => 'numeric|unique:articles,code|required'
        ]);

        return view('articles.create', [
            'newArticleCode' => $validated['article'],
            'clusters' => Cluster::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleStoreRequest $request)
    {
        $this->articleService->create($request);

        return Redirect::route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $article = Article::with(['stock', 'price', 'clusters'])->findOrFail($id);

        return view('articles.edit',
            [
                'article' => $article,
                'clusters' => Cluster::all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, string $id)
    {
        $this->articleService->update($request, $id);

        return Redirect::route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
//        $article->stock->delete();
//
//        $article->price->delete();
//
//        $article->delete();

        return Redirect::route('articles.index');
    }

    public function refill(ArticleRefillRequest $request, Article $article)
    {
        $this->articleService->addToStock($request, $article);

        return Redirect::route('articles.index');
    }
}
