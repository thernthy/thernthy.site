<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto">
            <div class="overflow-hidden shadow-xl sm:rounded-lg" style="background:#ffffffc7;">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
