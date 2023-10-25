<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <div>
                    <form action="{{ route('customers.update', $customer->id) }}" method="post">
                        @method('PUT')
                        @csrf

                        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                            <x-form-section submit="createCustomer">
                                <x-slot name="title">
                                    Modifica Cliente
                                </x-slot>

                                <x-slot name="description">
                                    In questa sezione puoi modificare un cliente.
                                </x-slot>

                                <x-slot name="form">

                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="name" value="Nome*" />
                                        <x-input id="name" type="text" class="mt-1 block w-full" name="name" value="{{ $customer->name }}"  />
                                        <x-input-error for="name" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="email" value="Email" />
                                        <x-input id="email" type="email" class="mt-1 block w-full" name="email" value="{{ $customer->email }}"  />
                                        <x-input-error for="email" class="mt-2" />
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

