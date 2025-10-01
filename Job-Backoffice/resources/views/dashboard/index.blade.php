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
                <p class="text-3xl font-bold text-indigo-600">{{ $analytics['activeUsers'] }}</p>
                <p class="text-sm text-gray-600">Last 30 Days</p>
            </div>

            <div class="p-6 bg-white overflow-hidden shadow-sm rounded-lg">
                <h3 class="text-lg font-medium text-gray-600">Total Jobs</h3>
                <p class="text-3xl font-bold text-indigo-600">{{ $analytics['totalJobs'] }}</p>
                <p class="text-sm text-gray-600">All Time</p>
            </div>

            <div class="p-6 bg-white overflow-hidden shadow-sm rounded-lg">
                <h3 class="text-lg font-medium text-gray-600">Total Applications</h3>
                <p class="text-3xl font-bold text-indigo-600">{{ $analytics['totalApplications'] }}</p>
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
                                @if(auth()->user()->role === 'admin')
                                <th class="py-2 uppercase text-gray-500">Company</th>
                                @endif
                                <th class="py-2 uppercase text-gray-500">Total Applications</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($analytics['mostAppliedJobs'] as $job)
                                <tr>
                                    <td class="py-4">{{ $job->title }}</td>
                                    @if(auth()->user()->role === 'admin')
                                    <td class="py-4">{{ $job->company->name }}</td>
                                    @endif
                                    <td class="py-4">{{ $job->TotalCount }}</td>
                                </tr>
                            @endforeach

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
                            @foreach ($analytics['conversionRates'] as $job)

                                <tr>
                                    <td class="py-4">{{ $job->title }}</td>
                                    <td class="py-4">{{ $job->viewCount }}</td>
                                    <td class="py-4">{{ $job->TotalCount }}</td>
                                    <td class="py-4">{{ $job->conversionRate }}%</td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

    </div>
</x-app-layout>
