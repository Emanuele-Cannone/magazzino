<div>
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="M9 5h6M9 8h6m-6 3h6M4.996 5h.01m-.01 3h.01m-.01 3h.01M2 1h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z"/>
            </svg>
            <h2 class="ml-3 text-xl font-semibold text-gray-900 dark:text-white">
                To Do List
            </h2>
        </div>


        <input type="text" wire:model="newTodo" x-model="newTodo" placeholder="Ricordami di..."
               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
               wire:keyup.enter="addTodo(this.newTodo)"
        >
    </div>

    <div x-data="{open: false}"
        x-init="new Hammer($el).on('swipeleft', function(ev) {open = true}).on('swiperight', function(ev) {open = false})"
        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-auto h-52">
            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                <thead
                    class="text-xs uppercase text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 cursor-pointer sticky top-0">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <td class="px-6 py-3">
                        Todo
                    </td>
                    <td class="px-6 py-3" x-show="open" x-transition>
                        Azioni
                    </td>
                </tr>
                </thead>
                <tbody>
                @foreach($todos as $todo)
                    <tr class="border-b border-gray-700" @swipeleft @swiperight>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">
                            <input type="checkbox"
                                   {{ $todo->done  ? 'checked' : '' }} wire:change="toggleDone({{ $todo->id }})">
                        </th>
                        <td class="px-6 py-4">
                            <p class="{{ $todo->done ? 'line-through' : ''}}">{{ $todo->todo }}</p>
                        </td>
                        <td class="px-6 py-4 flex justify-center" x-show="open" x-transition>
{{--                            <p x-show="!open" x-transition >Scroll to open</p>--}}
                            <button class="text-xs w-20 text-red-700 rounded bg-red-100 hover:bg-red-400 p-0"
                                    wire:click="removeTodo({{ $todo->id }})">
                                &cross;
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
