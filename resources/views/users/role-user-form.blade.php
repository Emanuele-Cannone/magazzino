@section('script')

    @vite(['resources/js/tagify.js'])

    <script type='text/javascript'>

        let tagifyDataSelected = @json($roleExists);

        let tagifyData = @json($roles
                    ->map(fn($role) => [
                            'id' => $role->id,
                            'value' => $role->name,
                            'editable' => false
                        ]
                    )
                ),
            inputElm = document.querySelectorAll('input[name=roles]');


    </script>

@endsection

<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <form action="{{ route('syncRoles', $user->id) }}" method="post">
        @method('POST')
        @csrf

        <x-form-section submit="createCustomer">
            <x-slot name="title">
                Modifica Utente
            </x-slot>

            <x-slot name="description">
                In questasezione puoi modificare i ruoli dell'utente selezionato.
            </x-slot>

            <x-slot name="form">

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="roles" value="Ruoli"/>
                    <x-input id="roles" type="text" class="mt-1 block w-full" name="roles"/>
                    <x-input-error for="roles" class="mt-2"/>
                </div>


            </x-slot>

            <x-slot name="actions">
                <x-button>
                    Modifica Ruoli Utente
                </x-button>
            </x-slot>
        </x-form-section>

    </form>
</div>


