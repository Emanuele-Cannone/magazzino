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

        let tagifyDataSelected = [];

    </script>

@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Aggiungi ricambio cod: <span>{{ $newArticleCode }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <div>
                    <form action="{{ route('articles.store') }}" method="post">
                        @method('POST')
                        <input type="hidden" name="code" value="{{ Request::get('article') }}">
                        @csrf
                        <x-form-section submit="createCustomer">
                            <x-slot name="title">
                                Aggiungi articolo
                            </x-slot>

                            <x-slot name="description">
                                In questa sezione puoi aggiungere un nuovo articolo non presente nel database, il
                                codice articolo è quello presente in alto
                            </x-slot>

                            <x-slot name="form">

                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="name" value="Nome"/>
                                    <x-input id="name" type="text" class="mt-1 block w-full" name="name"
                                             value="{{old('name')}}"/>
                                    <x-input-error for="name" class="mt-2"/>
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <div class="w-full">
                                        <label for="description"
                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrizione</label>
                                        <textarea id="description" name="description" rows="4"
                                                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        ></textarea>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-4 mt-2">
                                    <div class="flex">
                                        <div>
                                            <x-label for="min_quantity"
                                                     value="Quantità Min"/>
                                            <x-input id="min_quantity" type="number" class="mt-1 w-3/4"
                                                     name="min_quantity" value="{{old('min_quantity')}}"/>
                                            <x-input-error for="min_quantity" class="mt-2"/>
                                        </div>

                                        <div>
                                            <x-label for="quantity" value="Quantità"/>
                                            <x-input id="quantity" type="number" class="mt-1 w-3/4" name="quantity"
                                                     value="{{old('quantity')}}"/>
                                            <x-input-error for="quantity" class="mt-2"/>
                                        </div>

                                        <div>
                                            <x-label for="price" value="Prezzo"/>
                                            <x-input id="price" type="number" class="mt-1 w-3/4" name="price"
                                                     step="any" value="{{old('price')}}"/>
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
                                    Crea Articolo
                                </x-button>
                            </x-slot>
                        </x-form-section>

                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

