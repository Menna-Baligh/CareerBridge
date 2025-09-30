<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 px-6 flex flex-col gap-4">
        {{-- overview cards --}}
        <div class="grid grid-cols-3 gap-4">
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
            {{-- Most Applied Jobs  --}}
            <div class="p-6 bg-white overflow-hidden shadow-sm rounded-lg">
                <h3 class="text-lg font-medium text-gray-600">Most Applied Jobs</h3>
                <div>
                    <table class="w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="text-left">
                                <th class="py-2 uppercase text-gray-500">Job Title</th>
                                <th class="py-2 uppercase text-gray-500">Company</th>
                                <th class="py-2 uppercase text-gray-500">Total Applications</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="py-4">Software Engineer</td>
                                <td class="py-4">Google</td>
                                <td class="py-4">100</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- conversion rates --}}
            <div class="p-6 bg-white overflow-hidden shadow-sm rounded-lg">
                <h3 class="text-lg font-medium text-gray-600">Conversion Rates</h3>
                <div>
                    <table class="w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="text-left">
                                <th class="py-2 uppercase text-gray-500">Job Title</th>
                                <th class="py-2 uppercase text-gray-500">Views</th>
                                <th class="py-2 uppercase text-gray-500">Applications</th>
                                <th class="py-2 uppercase text-gray-500">Conversion Rate</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="py-4">Software Engineer</td>
                                <td class="py-4">100</td>
                                <td class="py-4">50</td>
                                <td class="py-4">50%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

    </div>
</x-app-layout>
