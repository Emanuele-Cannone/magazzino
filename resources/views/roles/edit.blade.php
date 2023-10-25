<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <div>
                    <form action="{{ route('roles.update', $role->id) }}" method="post">
                        @method('PUT')
                        @csrf

                        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                            <x-form-section submit="createCustomer">
                                <x-slot name="title">
                                    Modifica Ruolo
                                </x-slot>

                                <x-slot name="description">
                                    In questa sezione puoi modificare un ruolo.
                                </x-slot>

                                <x-slot name="form">

                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="name" value="Nome*" />
                                        <x-input id="name" type="text" class="mt-1 block w-full" name="name" value="{{ $role->name }}"  />
                                        <x-input-error for="name" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <div class="flex justify-between flex-wrap">
                                            @foreach($permissions as $permission)
                                                <div class="w-56">
                                                    <label class="relative inline-flex items-center mb-4 cursor-pointer">
                                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->name, $role->getPermissionNames()->toArray()) ? 'checked' : '' }} class="sr-only peer">
                                                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $permission->name }}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </x-slot>

                                <x-slot name="actions">
                                    <x-button>
                                        Modifica
                                    </x-button>
                                </x-slot>
                            </x-form-section>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
