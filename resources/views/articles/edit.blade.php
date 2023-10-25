@section('script')

    @vite(['resources/js/tagify.js'])

    <script type='text/javascript'>

        const tagifyData = @json($clusters
                ->map(fn($cluster) => [
                        'id' => $cluster->id,
                        'value' => $cluster->name,
                        'editable' => false
                    ]
                )
            );
        const inputElm = document.querySelectorAll('input[name=clusters]');

        let tagifyDataSelected = @json($article->clusters->map(fn($cluster) =>  $cluster->name));


    </script>

@endsection

<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('articles.update', $article->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    <x-form-section submit="createCustomer">
                        <x-slot name="title">
                            Modifica Ricambio
                        </x-slot>

                        <x-slot name="description">
                            In questa sezione puoi modificare un ricambio.
                        </x-slot>

                        <x-slot name="form">

                            <div class="col-span-6 sm:col-span-4">
                                <div class="flex">
                                    <div>
                                        <x-label for="name" value="Nome"/>
                                        <x-input id="name" type="text" class="mt-1 block w-full" name="name"
                                                 value="{{ $article->name }}"/>
                                        <x-input-error for="name" class="mt-2"/>
                                    </div>
                                    <div>
                                        <x-label for="code" value="Codice"/>
                                        <x-input id="code" type="text" class="mt-1 block w-full" name="code"
                                                 value="{{ $article->code }}"/>
                                        <x-input-error for="code" class="mt-2"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <div class="w-full">
                                    <label for="description"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrizione</label>
                                    <textarea id="description" name="description" rows="4"
                                              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    >{{ $article->description }}</textarea>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-4 mt-2">
                                <div class="flex">
                                    <div>
                                        <x-label for="min_quantity" value="Quantità Min"/>
                                        <x-input id="min_quantity" type="number" class="mt-1 w-3/4" name="min_quantity"
                                                 value="{{ $article->stock->min_stock }}"/>
                                        <x-input-error for="min_quantity" class="mt-2"/>
                                    </div>

                                    <div>
                                        <x-label for="quantity" value="Quantità"/>
                                        <x-input id="quantity" type="number" class="mt-1 w-3/4" name="quantity"
                                                 value="{{ $article->stock->current_stock }}"/>
                                        <x-input-error for="quantity" class="mt-2"/>
                                    </div>

                                    <div>
                                        <x-label for="price" value="Prezzo"/>
                                        <x-input id="price" type="number" step="0.5" class="mt-1 w-3/4"
                                                 name="price" value="{{ $article->price->price }}" step="any"
                                        />
                                        <x-input-error for="price" class="mt-2"/>
                                    </div>
                                </div>

                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="clusters" value="Gruppi"/>
                                <x-input id="clusters" type="text" class="mt-1 block w-full" name="clusters"/>
                                <x-input-error for="clusters" class="mt-2"/>
                            </div>


                        </x-slot>

                        <x-slot name="actions">
                            <x-button>
                                Modifica Articolo
                            </x-button>
                        </x-slot>
                    </x-form-section>

                </div>
            </form>
        </div>
    </div>
</x-app-layout>

