@section('script')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css"/>

    <script>

        let customerInput = document.querySelector('input[name="customers"]'),
            // init Tagify script on the above inputs
            customerTagify = new Tagify(customerInput, {
                whitelist: @json($customers
                    ->map(fn($customer) => [
                            'id' => $customer->id,
                            'value' => $customer->name,
                            'editable' => false
                        ]
                    )
                ),
                maxTags: 10,
                dropdown: {
                    maxItems: 20,           // <- mixumum allowed rendered suggestions
                    classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                    enabled: 0,             // <- show suggestions on focus
                    closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
                }
            })

        let buyerInput = document.querySelector('input[name="buyers"]'),
            // init Tagify script on the above inputs
            buyerTagify = new Tagify(buyerInput, {
                whitelist: @json($customers
                    ->map(fn($customer) => [
                            'id' => $customer->id,
                            'value' => $customer->name,
                            'editable' => false
                        ]
                    )
                ),
                maxTags: 10,
                dropdown: {
                    maxItems: 20,           // <- mixumum allowed rendered suggestions
                    classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                    enabled: 0,             // <- show suggestions on focus
                    closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
                }
            })
        
    </script>

@endsection


<x-app-layout>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mt-3 bg-gray-200 rounded dark:bg-gray-800 bg-opacity-25 p-6 lg:p-8 w-full">

            <form action="#" method="post">
                @method('POST')
                @csrf

                <div class="flex">
                    <div class="w-2/4">
                        <x-label for="customers" value="Clienti"/>
                        <x-input id="customers" type="text" class="mt-1 w-full" name="customers"/>
                        <x-input-error for="customers" class="mt-2"/>
                    </div>

                    <div class="w-2/4 mx-2">
                        <x-label for="buyers" value="Committenti"/>
                        <x-input id="buyers" type="text" class="mt-1 w-full" name="buyers"/>
                        <x-input-error for="buyers" class="mt-2"/>
                    </div>
                </div>

                <div class="mt-5">
                    <x-label for="problems" value="Lamentela"/>
                    <x-input type="text" class="w-full" name="problems"/>
                    <x-input-error for="problems" class="mt-2"/>
                </div>

            </form>

        </div>


    </div>
</x-app-layout>

