<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ArticlesUnderProvisionList extends Component
{
    public function render()
    {
        $articles = Article::with(['stock'])->whereHas('stock', function (Builder $query) {
            $query->whereColumn('current_stock', '<=', 'min_stock');
        })->get();

        return view('livewire.articles-under-provision-list',
            [
                'articles' => $articles
            ]
        );
    }

    public function toggleInOrder($article)
    {
        $validated = Article::findOrFail($article);

        $validated->update([
            'in_order' => !$validated->in_order
        ]);


    }
}
