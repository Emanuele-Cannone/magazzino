@section('script')

    @vite(['resources/js/tagify.js'])

    <script type='text/javascript'>

        const tagifyData = @json($users
                ->map(fn($user) => [
                        'id' => $user->id,
                        'value' => $user->name,
                        'editable' => false
                    ]
                )
            );

        const inputElm = document.querySelectorAll('input[name=users]');

        let tagifyDataSelected = [];

    </script>

@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nuova scheda lavori
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <div>
                    <form action="{{ route('worksheets.store') }}" method="post">
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

                                    <div class="col-span-6 sm:col-span-4">
                                        <div class="w-full">
                                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrizione</label>
                                            <textarea id="description" name="description" rows="4"
                                                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            ></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4 mt-2">
                                        <div class="flex">
                                            <div>
                                                <x-label for="min_quantity" value="{{ __('progen.customer.min_quantity') }}" />
                                                <x-input id="min_quantity" type="number" class="mt-1 w-3/4" name="min_quantity" value="{{old('min_quantity')}}"  />
                                                <x-input-error for="min_quantity" class="mt-2" />
                                            </div>

                                            <div>
                                                <x-label for="quantity" value="{{ __('progen.customer.quantity') }}" />
                                                <x-input id="quantity" type="number" class="mt-1 w-3/4" name="quantity" value="{{old('quantity')}}"  />
                                                <x-input-error for="quantity" class="mt-2" />
                                            </div>

                                            <div>
                                                <x-label for="price" value="{{ __('progen.customer.price') }}" />
                                                <x-input id="price" type="number" class="mt-1 w-3/4" name="price" value="{{old('price')}}"  />
                                                <x-input-error for="price" class="mt-2" />
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="users" value="{{ __('progen.customer.customer_users') }}" />
                                        <x-input id="users" type="text" class="mt-1 block w-full" name="users"  />
                                        <x-input-error for="users" class="mt-2" />
                                    </div>

{{--                                    <input type="datetime-local">--}}

                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="customer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                                        <select id="customer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option selected disabled>Choose a country</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-span-6 sm:col-span-4">
                                        <x-jobs></x-jobs>
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

