<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\Cluster;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleList extends Component
{

    use WithPagination;

    public $perPage = 5;
    public $orderColumn = 'name';
    public $sortOrder = 'asc';
    public $sortLink = '<i class="fa-solid fa-caret-up"></i>';
    public $searchArticle = '';

    public function loadMore()
    {
        $this->perPage += 5;
    }

    public function updated()
    {
        $this->resetPage();
    }


    public function sortOrder($columnName = '')
    {
        $caretorder = 'up';
        if($this->sortOrder == 'asc'){
            $this->sortOrder = 'desc';
            $caretorder = 'down';
        } else {
            $this->sortOrder = 'asc';
            $caretorder = 'up';
        }
        $this->sortLink = '<i class="fa-solid fa-caret-'.$caretorder.'"></i>';
        $this->orderColumn = $columnName;

    }

    public function render()
    {
        $articles = Article::with(['stock', 'price'])->orderBy($this->orderColumn, $this->sortOrder);

        if(!empty($this->searchArticle)){
            $articles = Article::with(['stock', 'price', 'clusters'])
                    ->where('name','LIKE','%'.$this->searchArticle.'%')
                    ->orWhere('code','LIKE','%'.$this->searchArticle.'%')
                    ->orWherehas('clusters', function ($query) {
                        return $query->where('name', 'LIKE', '%'.$this->searchArticle.'%');
                    })->orderBy($this->orderColumn, $this->sortOrder);

        }

        $articles = $articles->paginate($this->perPage);

        return view('articles.article-list', [
            'articles' => $articles,
            'addArticle' => $articles->isEmpty()
        ]);
    }
}
