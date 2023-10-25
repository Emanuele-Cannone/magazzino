<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <div>
                    <form action="{{ route('clusters.update', $cluster->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                            <x-form-section submit="createCustomer">
                                <x-slot name="title">
                                    Modifica Gruppo
                                </x-slot>

                                <x-slot name="description">
                                    In questa sezione puoi modificare il nome del gruppo.
                                </x-slot>

                                <x-slot name="form">

                                    <div class="col-span-6 sm:col-span-4">
                                        <div>
                                            <x-label for="name" value="Nome" />
                                            <x-input id="name" type="text" class="mt-1 block w-full" name="name" value="{{ $cluster->name }}"  />
                                            <x-input-error for="name" class="mt-2" />
                                        </div>
                                    </div>

                                </x-slot>

                                <x-slot name="actions">
                                    <x-button>
                                        Modifica Gruppo
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

