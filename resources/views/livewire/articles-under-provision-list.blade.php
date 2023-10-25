<div>
    <div class="flex items-center justify-between mb-4 mt-2">
        <div class="flex items-center mb-1.5">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="18" height="20" fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="1.3" d="M12 2h4a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h4m6 0v3H6V2m6 0a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1M5 5h8m-5 5h5m-8 0h.01M5 14h.01M8 14h5"/>
            </svg>
            <h2 class="ml-3 text-xl font-semibold text-gray-900 dark:text-white">
                Ricambi in carenza
            </h2>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-auto h-52">
            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                <thead
                    class="text-xs uppercase text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 cursor-pointer sticky top-0">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <td class="px-6 py-3">
                        Nome
                    </td>
                    <td class="px-6 py-3">
                        Minimo
                    </td>
                    <td class="px-6 py-3">
                        Attuale
                    </td>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr class="border-b border-gray-700 {{ $article->in_order ? 'line-through' : ''}}">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">
                            <input type="checkbox"
                                   {{ $article->in_order  ? 'checked' : '' }} wire:change="toggleInOrder({{ $article->id }})"
                            >
                        </th>
                        <td class="px-6 py-4">
                            <p>{{ $article->name }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p>{{ $article->stock->min_stock }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p>{{ $article->stock->current_stock }}</p>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
