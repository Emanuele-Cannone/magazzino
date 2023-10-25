<x-app-layout>
{{--    <div class="py-12">--}}
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <livewire:role-user-form :roles="$roles" :user="$user" :roleExists="$roleExists"/>
        </div>
{{--    </div>--}}
</x-app-layout>

