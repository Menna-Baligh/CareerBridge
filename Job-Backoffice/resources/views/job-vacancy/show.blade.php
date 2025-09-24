<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ $jobVacancy->title }}
        </h2>
    </x-slot>

    <div class="bg-gray-50 min-h-screen p-6">
        <x-toast-notification />

        <div class="w-full max-w-4xl mx-auto p-6 bg-white rounded-2xl shadow-lg border border-gray-100">

            {{-- job Info --}}
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-purple-700 mb-4">💼 Job Info</h3>
                <div class="space-y-2 text-gray-700">
                    <p><strong class="text-gray-900">Location:</strong> {{ $jobVacancy->location }}</p>
                    <p><strong class="text-gray-900">Type:</strong> {{ $jobVacancy->type }}</p>
                    <p><strong class="text-gray-900">Salary:</strong> USD {{ Number::abbreviate($jobVacancy->salary) }}</p>
                    <p><strong class="text-gray-900">Company-Name:</strong> {{ $jobVacancy->company->name }}</p>

                    <p>
                        <strong class="text-gray-900">Description:</strong>
                            {{ $jobVacancy->description }}
                    </p>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end space-x-3 mb-6">
                <!-- Cancel Button -->
                <a href="{{ route('job-vacancy.index') }}"
                    class="text-sm px-4 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 border border-red-200 transition flex items-center">
                    ⬅ Back
                </a>
                <a href="{{ route('job-vacancy.edit', ['job_vacancy' => $jobVacancy->id,'redirectToShow'=>true]) }}"
                    class="text-sm px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                    ✏️ Edit
                </a>
                <form action="{{ route('job-vacancy.destroy', $jobVacancy->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="text-sm px-4 py-2 rounded-lg bg-purple-100 text-purple-700 hover:bg-purple-200 transition">
                        🗑️ Archive
                    </button>
                </form>
            </div>

            {{-- Tabs Navigation --}}
            <div class="mb-6">
                <ul class="flex space-x-4">
                    <li>
                        <a href="{{ route('job-vacancy.show', ['job_vacancy' => $jobVacancy->id, 'tab' => 'applications']) }}"
                            class="px-4 py-2 rounded-lg text-sm font-semibold transition
                            {{ request('tab') == 'applications' || request('tab') == ''
                                ? 'bg-purple-600 text-white shadow'
                                : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            📑 Applications
                        </a>
                    </li>

                </ul>
            </div>

            {{-- Tabs Content --}}
            <div class="mt-4">
                {{-- applications --}}
                <div id="applications" class="{{ request('tab') == 'applications'|| request('tab') == '' ? 'block' : 'hidden' }}">
                    <h3 class="text-lg font-semibold text-purple-700 mb-4">Available Applications</h3>

                    @if($jobVacancy->jobApplications->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg">
                                <thead class="bg-purple-100 text-purple-700 text-sm uppercase">
                                    <tr>
                                        <th class="px-6 py-3">Applicant</th>
                                        <th class="px-6 py-3">Applied At</th>
                                        <th class="px-6 py-3">Status</th>
                                        <th class="px-6 py-3 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jobVacancy->jobApplications as $application)
                                        <tr class="bg-white border-b hover:bg-gray-50 transition">
                                            {{-- Applicant Name --}}
                                            <td class="px-6 py-4 font-medium text-gray-900">
                                                {{ $application->user->name ?? 'N/A' }}
                                            </td>

                                            {{-- Applied At --}}
                                            <td class="px-6 py-4">
                                                {{ $application->created_at->diffForHumans() }}
                                            </td>

                                            {{-- Status --}}
                                            <td class="px-6 py-4">
                                                <span class="px-3 py-1 text-xs rounded-full
                                                    @if($application->status == 'pending') bg-yellow-100 text-yellow-700
                                                    @elseif($application->status == 'accepted') bg-green-100 text-green-700
                                                    @elseif($application->status == 'rejected') bg-red-100 text-red-700
                                                    @endif">
                                                    {{ ucfirst($application->status) }}
                                                </span>
                                            </td>

                                            {{-- Actions --}}
                                            <td class="px-6 py-4 text-center">
                                                <a href="{{ route('application.show', $application->id) }}"
                                                class="px-3 py-1 text-xs rounded-lg bg-purple-100 text-purple-700 hover:bg-purple-200 transition">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-4 border rounded-lg text-gray-600 bg-gray-50 text-center">
                            No Applications listed yet.
                        </div>
                    @endif
                </div>




            </div>
        </div>
    </div>
</x-app-layout>
