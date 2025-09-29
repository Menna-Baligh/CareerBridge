<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 px-6">
        {{-- overview cards --}}
        <div class="grid grid-cols-3 gap-6">
            <div class="p-6 bg-white overflow-hidden shadow-sm rounded-lg">
                <h3 class="text-lg font-medium text-gray-600">Active Users</h3>
                <p class="text-3xl font-bold text-indigo-600">100</p>
                <p class="text-sm text-gray-600">Last 30 Days</p>
            </div>

            <div class="p-6 bg-white overflow-hidden shadow-sm rounded-lg">
                <h3 class="text-lg font-medium text-gray-600">Total Jobs</h3>
                <p class="text-3xl font-bold text-indigo-600">100</p>
                <p class="text-sm text-gray-600">All Time</p>
            </div>

            <div class="p-6 bg-white overflow-hidden shadow-sm rounded-lg">
                <h3 class="text-lg font-medium text-gray-600">Total Applications</h3>
                <p class="text-3xl font-bold text-indigo-600">100</p>
                <p class="text-sm text-gray-600">All Time</p>
            </div>
        </div>
    </div>
</x-app-layout>
