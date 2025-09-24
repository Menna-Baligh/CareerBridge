<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
                {{ $application->user->name }}
            <span class="text-gray-500 text-lg">applied to</span>
                {{ $application->jobVacany->title }}
        </h2>
    </x-slot>

    <div class="bg-gray-50 min-h-screen p-6">
        <x-toast-notification />

        <div class="w-full max-w-5xl mx-auto p-6 bg-white rounded-2xl shadow-lg border border-gray-100">

            {{-- Application Info --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="p-5 bg-purple-50 rounded-xl border border-purple-100">
                    <h3 class="text-lg font-semibold text-purple-700 mb-3">📑 Application Details</h3>
                    <p><strong>Status:</strong>
                        <span class="px-3 py-1 text-xs rounded-full
                            @if($application->status == 'pending') bg-yellow-100 text-yellow-700
                            @elseif($application->status == 'accepted') bg-green-100 text-green-700
                            @elseif($application->status == 'rejected') bg-red-100 text-red-700
                            @endif">
                            {{ ucfirst($application->status) }}
                        </span>
                    </p>
                    <p><strong>Company:</strong> {{ $application->jobVacany->company->name }}</p>
                    <p><strong>Resume:</strong>
                        <a href="{{ $application->resume->fileUri }}" target="_blank"
                            class="text-purple-600 hover:text-purple-800 underline">
                            View Resume
                        </a>
                    </p>
                </div>

                <div class="p-5 bg-gray-50 rounded-xl border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">💼 Job Details</h3>
                    <p><strong>Title:</strong> {{ $application->jobVacany->title }}</p>
                    <p><strong>Location:</strong> {{ $application->jobVacany->location }}</p>
                    <p><strong>Type:</strong> {{ $application->jobVacany->type }}</p>
                </div>
            </div>
            {{-- Action Buttons --}}
            <div class="flex justify-end mb-6 space-x-3">
                {{-- Back Button --}}
                <a href="{{ url()->previous() }}"
                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg shadow hover:bg-gray-200 transition">
                    ⬅️ Back
                </a>

                {{-- Archive Button --}}
                <form action="{{ route('application.destroy', $application->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to archive this application?');">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                            class="px-4 py-2 bg-red-100 text-red-600 rounded-lg shadow hover:bg-red-200 transition">
                        🗄️ Archive
                    </button>
                </form>

                {{-- Edit Button with query param --}}
                <a href="{{ route('application.edit', ['application' => $application->id, 'redirectToShow' => 'true']) }}"
                class="px-4 py-2 bg-purple-600 text-white rounded-lg shadow hover:bg-purple-700 transition">
                    ✏️ Edit
                </a>
            </div>


            {{-- Tabs --}}
            <div class="mb-6">
                <ul class="flex space-x-4">
                    <li>
                        <a href="{{ route('application.show', ['application' => $application->id, 'tab' => 'resume']) }}"
                            class="px-4 py-2 rounded-lg text-sm font-semibold transition
                            {{ request('tab') == 'resume' || request('tab') == ''
                                ? 'bg-purple-600 text-white shadow'
                                : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            📄 Resume
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('application.show', ['application' => $application->id, 'tab' => 'feedback']) }}"
                            class="px-4 py-2 rounded-lg text-sm font-semibold transition
                            {{ request('tab') == 'feedback'
                                ? 'bg-purple-600 text-white shadow'
                                : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            🤖 AI Feedback
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Tab Content --}}
            <div class="mt-4">
                {{-- Résumé --}}
                <div id="resume" class="{{ request('tab') == 'resume' || request('tab') == '' ? 'block' : 'hidden' }}">
                    <h3 class="text-lg font-semibold text-purple-700 mb-4">📄 Resume Details</h3>
                    <div class="space-y-4">
                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <h4 class="font-semibold text-gray-800">Summary</h4>
                            <p class="text-gray-600">{{ $application->resume->summary ?? 'No summary provided.' }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <h4 class="font-semibold text-gray-800">Skills</h4>
                            <p class="text-gray-600">{{ $application->resume->skills ?? 'No skills listed.' }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <h4 class="font-semibold text-gray-800">Education</h4>
                            <p class="text-gray-600">{{ $application->resume->education ?? 'No education listed.' }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <h4 class="font-semibold text-gray-800">Experience</h4>
                            <p class="text-gray-600">{{ $application->resume->experience ?? 'No experience listed.' }}</p>
                        </div>
                    </div>
                </div>

                {{-- AI Feedback --}}
                <div id="feedback" class="{{ request('tab') == 'feedback' ? 'block' : 'hidden' }}">
                    <h3 class="text-lg font-semibold text-purple-700 mb-4">🤖 AI Feedback</h3>
                    <div class="p-5 bg-gray-50 rounded-xl border border-gray-100 space-y-4">
                        <p><strong>Score:</strong> {{ $application->aiGeneratedScore ?? 'N/A' }}</p>
                        <p><strong>Feedback:</strong> {{ $application->aiGeneratedFeedback ?? 'No feedback available.' }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
