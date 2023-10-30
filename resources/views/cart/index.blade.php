@section('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        $(document).ready(function() {
            $('#customer').select2({
                placeholder: 'Seleziona un cliente',
                data: @js($customers),
                allowClear: true
            });
        });

    </script>
@endsection
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Carrello
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs uppercase text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 cursor-pointer">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nome
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Codice
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Quantità
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
                            @foreach ($cartItems as $key => $item)
                                <tr class="border-b border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200"
                                    >
                                        {{ $item['article']->name}}
                                    </th>
                                    <td class="px-6 py-4">{{ $item['article']->code}}</td>
                                    <td class="px-6 py-4">{{ $item['quantity']}}</td>
                                    <td class="px-6 py-4">{{ $item['price']}}</td>
                                    <td>
                                        <form action="{{ route('cart.destroy', ['cart' => $key]) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                    class="text-xs w-16 text-red-700 px-2 py-1 rounded bg-red-100 hover:bg-red-400"
                                            >
                                                Elimina
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="flex my-2 px-2 text-gray-900 whitespace-nowrap dark:text-white">
                            Totale carrello: {{ $cartItems->pluck('price')->sum() }} €
                        </div>
                        <div class="flex justify-end items-center">
                            <div class="flex px-2 ">
                                <form action="{{ route('orders.store') }}" method="post">
                                    @method('POST')
                                    @csrf
                                    <select name="customer_id" id="customer" class="w-full"></select>
                                    <button type="submit"
                                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900"
                                    >
                                        Invia ordine
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>



