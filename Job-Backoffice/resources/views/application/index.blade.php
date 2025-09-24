<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
            {{ __('Job Applications') }} {{ request('archived') ? '(Archived)' : '' }}
        </h2>
    </x-slot>

    <x-toast-notification />

    <div class="overflow-x-auto p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="space-x-2">
                <a href="{{ route('application.index') }}"
                    class="px-4 py-2 rounded-lg text-sm font-semibold shadow-sm transition
                        {{ request('archived') ? 'bg-gray-200 text-gray-600 hover:bg-gray-300' : 'bg-purple-600 text-white hover:bg-purple-700' }}">
                    Active
                </a>
                <a href="{{ route('application.index', ['archived' => true]) }}"
                    class="px-4 py-2 rounded-lg text-sm font-semibold shadow-sm transition
                        {{ request('archived') ? 'bg-purple-600 text-white hover:bg-purple-700' : 'bg-gray-200 text-gray-600 hover:bg-gray-300' }}">
                    Archived
                </a>
            </div>

        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-purple-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Applicant Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Postion (Job Vacancy)</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Company</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($jobApplications as $jobApplication)
                        <tr class="hover:bg-purple-50 transition">
                            <td class="px-6 py-4 text-gray-800 font-medium">
                                @if (request('archived'))
                                    <span class="text-gray-400">
                                        {{ $jobApplication->user->name }}
                                    </span>
                                @else
                                    <a href="{{ route('user.show', $jobApplication->user->id) }}"
                                    class="text-purple-600 hover:text-purple-800">
                                        {{ $jobApplication->user->name }}
                                    </a>
                                @endif

                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $jobApplication->jobVacany->title ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $jobApplication->jobVacany->company->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4">
                                                <span class="px-3 py-1 text-xs rounded-full
                                                    @if($jobApplication->status == 'pending') bg-yellow-100 text-yellow-700
                                                    @elseif($jobApplication->status == 'accepted') bg-green-100 text-green-700
                                                    @elseif($jobApplication->status == 'rejected') bg-red-100 text-red-700
                                                    @endif">
                                                    {{ ucfirst($jobApplication->status) }}
                                                </span>
                                </td>
                            <td class="px-6 py-4 flex items-center space-x-3">
                                @if(request('archived'))
                                    <form action="{{ route('application.restore', $jobApplication->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="flex items-center text-green-600 hover:text-green-800 font-medium transition">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="w-5 h-5 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 12a9 9 0 1118 0 9 9 0 01-18 0zm9-3v6m3-3H9" />
                                            </svg>
                                            Restore
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('application.edit', $jobApplication) }}"
                                        class="flex items-center text-purple-600 hover:text-purple-800 font-medium transition">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="w-5 h-5 mr-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.651 1.65a1.875 1.875 0 010 2.652l-8.25
                                                    8.25a4.5 4.5 0 01-1.897 1.13l-2.651.757a.375.375 0
                                                    01-.465-.465l.757-2.651a4.5 4.5 0
                                                    011.13-1.897l8.25-8.25a1.875 1.875
                                                    0 012.652 0z" />
                                        </svg>
                                        Edit
                                    </a>

                                    <form action="{{ route('application.destroy', $jobApplication) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex items-center text-red-600 hover:text-red-800 font-medium transition">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="w-5 h-5 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 9.75L18.868 19.5a2.25
                                                        2.25 0 01-2.244 2.001H7.376a2.25
                                                        2.25 0 01-2.244-2.001L4.5
                                                        9.75m9.75-3V4.875c0-.621-.504-1.125-1.125-1.125h-1.25c-.621
                                                        0-1.125.504-1.125 1.125V6.75m-6
                                                        0h14.25" />
                                            </svg>
                                            Archive
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-4 text-gray-600" colspan="5">
                                No job Applications found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $jobApplications->links() }}
        </div>
    </div>
</x-app-layout>
