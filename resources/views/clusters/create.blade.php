<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Aggiungi cluster
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <div>
                    <form action="{{ route('clusters.store') }}" method="post">
                        @method('POST')
                        @csrf
                        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                            <x-form-section submit="createCustomer">
                                <x-slot name="title">
                                    {{ __('progen.customer.new_customer') }}
                                </x-slot>

                                <x-slot name="description">
                                    {{ __('progen.customer.new_customer_details') }}
                                </x-slot>

                                <x-slot name="form">

                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="name" value="{{ __('progen.customer.customer_name') }}" />
                                        <x-input id="name" type="text" class="mt-1 block w-full" name="name" value="{{old('name')}}"  />
                                        <x-input-error for="name" class="mt-2" />
                                    </div>

                                </x-slot>

                                <x-slot name="actions">
                                    <x-button>
                                        {{ __('common.create') }}
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

