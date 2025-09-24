<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Job Application Status
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 space-y-6">
        <!-- Applicant Info -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Applicant Details</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-600 text-sm">Name</label>
                    <p class="text-gray-900 font-medium">{{ $application->user->name }}</p>
                </div>
                <div>
                    <label class="block text-gray-600 text-sm">Email</label>
                    <p class="text-gray-900 font-medium">{{ $application->user->email }}</p>
                </div>
                <div>
                    <label class="block text-gray-600 text-sm">Applied For</label>
                    <p class="text-gray-900 font-medium">{{ $application->jobVacany->title }}</p>
                </div>
                <div class="col-span-2">
                    <label class="block text-gray-600 text-sm">Company</label>
                    <p class="text-gray-900 font-medium">{{ $application->jobVacany->company->name }}</p>
                </div>

            </div>
        </div>

        <!-- Status Update Form -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Update Status</h3>
            <form action="{{ route('application.update', ['application' => $application->id , 'redirectToShow'=>request('redirectToShow')]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-medium">Status</label>
                    <select id="status" name="status"
                        class="mt-2 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                        <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('application.index') }}"
                        class="mr-3 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
