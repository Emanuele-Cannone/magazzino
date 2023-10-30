<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Rif Ordine: {{ $order->id }} del {{ $order->created_at->format('d-m-Y') }}
        </h2>

        <a href="{{ route('orders.index') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Elenco Ordini</a>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                    <thead class="text-xs uppercase text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 cursor-pointer">
                    <tr>
                        <th scope="col" class="px-6 py-3 rounded-l-lg">
                            Articolo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantità
                        </th>
                        <th scope="col" class="px-6 py-3 rounded-r-sm">
                            Prezzo
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->articles as $article)
                        <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $article->article->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $article->quantity }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $article->price }}€
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr class="font-semibold text-gray-900 dark:text-white">
                        <th scope="row" class="px-6 py-3 text-base">Totale</th>
                        <td class="px-6 py-3">{{ $order->articles->sum('quantity') }}</td>
                        <td class="px-6 py-3">{{ $order->articles->sum('price') }}€</td>
                    </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

