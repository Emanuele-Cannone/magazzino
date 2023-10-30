<div>
    <x-input class="my-2" type="text" placeholder="Cerca per nome, email" wire:model="searchCustomer"/>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 cursor-pointer">
                    <tr>
                        <th scope="col" class="px-6 py-3" wire:click="sortOrder('name')">
                            Nome
                            {!! $sortLink !!}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        @canany(['Modifica Cliente','Elimina Cliente'])
                        <th scope="col" class="px-6 py-3">
                            Azioni
                        </th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr class="border-b border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">{{ $customer->name}}</th>
                            <td class="px-6 py-4">{{ $customer->email}}</td>
                            @canany(['Modifica Cliente','Elimina Cliente'])
                            <td class="px-6 py-4 flex items-center justify-center">
                                @can('Modifica Cliente')
                                <a href="{{route('customers.edit', $customer->id )}}" class="mr-1 focus:outline-none text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                                    <i class="fa-solid fa-user-pen"></i>
                                </a>
                                @endcan
                                @can('Elimina Cliente')
                                <form action="{{route('customers.destroy', $customer->id )}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                    >
                                        <i class="fa-solid fa-user-xmark"></i>
                                    </button>
                                </form>
                                @endcan
                            </td>
                                @endcanany
                        </tr>
                    @endforeach
                    </div>
                </tbody>
            </table>
        </div>
    {{ $customers->links() }}
    </div>
</div>
