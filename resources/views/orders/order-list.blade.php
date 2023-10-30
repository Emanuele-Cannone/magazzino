<div>
    <x-input class="my-2" type="text" placeholder="Cerca per cliente" wire:model="searchOrder"/>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 cursor-pointer">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cliente
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Prezzo
                        </th>
                        <th scope="col" class="px-6 py-3" wire:click="sortOrder('created_at')">
                            Data
                            {!! $sortLink !!}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Azioni
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-b border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">{{ $order->id}}</th>
                            <td class="px-6 py-4">{{ $order->customer->name}}</td>
                            <td class="px-6 py-4">{{ $order->articles->sum('price') }}€</td>
                            <td class="px-6 py-4">{{ $order->created_at->format('d-m-Y')}}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('orders.show', $order) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Vedi Ordine</a>
                            </td>
                        </tr>
                    @endforeach
                    </div>
                </tbody>
            </table>
        </div>
    {{ $orders->links() }}
    </div>
</div>
