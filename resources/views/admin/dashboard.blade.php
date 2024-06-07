<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <p>User ID : {{ Auth::user()->id }}
                    </p>
                    <p>Email : {{ Auth::user()->email }} </p>
                    <p>User Type : {{ Auth::user()->is_admin }}</p>
                </div>
            </div><br>
            <x-admintable></x-admintable>
        </div>
    </div>
</x-app-layout>
