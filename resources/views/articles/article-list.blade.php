<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-input class="my-2 w-64" type="text" placeholder="Cerca per nome, codice, gruppo" wire:model="searchArticle"
                 x-model="newArticle"/>
        @if($addArticle)
            <a x-bind:href="'{{ route('articles.create', '') }}' + '?article=' + newArticle" >
                <button
                    class="ml-2 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                >
                    Aggiungi
                </button>
            </a>
        @endif
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                    <thead
                        class="text-xs uppercase text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 cursor-pointer">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Codice
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nome
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Descrizione
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Gruppi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Unità
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Prezzo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Azioni
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($articles as $article)
                        <tr class="border-b border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">{{ $article->code}}</th>
                            <td class="px-6 py-4">{{ $article->name}}</td>
                            <td class="px-6 py-4 max-w-md">{{ $article->description}}</td>
                            <td class="px-6 py-4 flex flex-wrap justify-center">
                                @foreach($article->clusters as $articleCluster)
                                    <span
                                        class="my-1 bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 border border-green-400">
                                        {{ $articleCluster->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-6 py-4">{{ $article->stock->current_stock}}</td>
                            <td class="px-6 py-4">{{ $article->price->price}}€</td>
                            <td class="px-6 py-4 flex items-center justify-center">
                                <div class="flex flex-col">
                                    <div>
                                        <button x-on:click="articleId = {{ $article->id }}, maxCount = {{ $article->stock->current_stock}}"
                                                data-modal-target="addToCartModal" data-modal-toggle="addToCartModal"
                                                class="w-full focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </button>
                                    </div>
                                    <div class="my-1 flex justify-around items-center w-full">
                                        <div class="mr-1">
                                            <button
                                                x-on:click="articleCode = {{ $article->code }}, articleId = {{ $article->id }}"
                                                data-modal-target="refillToStockModal"
                                                data-modal-toggle="refillToStockModal"
                                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                <i class="fa-solid fa-dolly"></i>
                                            </button>
                                        </div>
                                        <div class="ml-1">
                                            <a href="{{ route('articles.edit', $article->id) }}">
                                                <button
                                                    class="focus:outline-none text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800"
                                                >
                                                    <i class="fa-solid fa-edit"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    <div>
                                        <button x-on:click="articleId = {{ $article->id }}"
                                                data-modal-target="deleteArticleModal" data-modal-toggle="deleteArticleModal"
                                                class="w-full mb-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                        >
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $articles->links() }}
    </div>

</div>
