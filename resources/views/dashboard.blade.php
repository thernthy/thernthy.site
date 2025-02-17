<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
        <div class="mx-auto" style="background:#02194fe0;">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
               <x-chartjs-component :chart="$chart" />
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
