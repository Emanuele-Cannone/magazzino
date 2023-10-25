<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-input class="my-2 w-64" type="text" placeholder="Cerca per nome, codice, gruppo" wire:model="searchCluster" />
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                    <thead
                        class="text-xs uppercase text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 cursor-pointer">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <td class="px-6 py-3">
                            Nome
                        </td>
                        <td class="px-6 py-3">
                            Azioni
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($clusters as $key => $cluster)
                        <tr class="border-b border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">{{ ++$key }}</th>
                            <td class="px-6 py-4">{{ $cluster->name}}</td>
                            <td class="px-6 py-4 flex justify-center">
                                <a href="{{ route('clusters.edit', $cluster->id) }}" class="mr-2">
                                    <button
                                        class="focus:outline-none text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800"
                                    >
                                        <i class="fa-solid fa-edit"></i>
                                    </button>
                                </a>
                                <form action="{{ route('clusters.destroy', $cluster->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button
                                        type="submit"
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                    >
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $clusters->links() }}
    </div>

</div>
