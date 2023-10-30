<div>
    <x-input class="my-2" type="text" placeholder="Cerca per utente" wire:model="searchUser"/>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 cursor-pointer">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Utente
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Azione
                    </th>
                    <th scope="col" class="px-6 py-3" wire:click="sortOrder('created_at')">
                        Data
                        {!! $sortLink !!}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($actions as $action)
                    <tr class="border-b border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">{{ $action->id }}</th>
                        <td class="px-6 py-4">{{ $action->user->name}}</td>
                        <td class="px-6 py-4">{{ $action->action }}</td>
                        <td class="px-6 py-4">{{ $action->created_at }}</td>
                    </tr>
            @endforeach
        </div>
        </tbody>
        </table>
    </div>
    {{ $actions->links() }}
</div>
</div>
