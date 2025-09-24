<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('job-vacancy.index') }}"
                class="px-3 py-1 bg-gray-200 hover:bg-gray-300 text-sm rounded-lg">
                ← Back
            </a>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Job Vacancy - {{ $jobVacancy->title }}
            </h2>
        </div>
    </x-slot>

    <x-toast-notification />

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-2xl p-8">

                <form action="{{ route('job-vacancy.update', ['job_vacancy' => $jobVacancy->id,'redirectToShow'=>request('redirectToShow')]) }}" method="POST" class="space-y-10">
                    @csrf
                    @method('PUT')

                    <!-- Job Info -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-700 border-b pb-2 mb-6">Job Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Title -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Job Title</label>
                                <input type="text" name="title" value="{{ old('title', $jobVacancy->title) }}"
                                    class="mt-1 w-full rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200
                                    @error('title') border-red-500 @else border-gray-300 @enderror"
                                    placeholder="e.g. Software Engineer">
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Location -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Location</label>
                                <input type="text" name="location" value="{{ old('location', $jobVacancy->location) }}"
                                    class="mt-1 w-full rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200
                                    @error('location') border-red-500 @else border-gray-300 @enderror"
                                    placeholder="e.g. Cairo, Egypt">
                                @error('location')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Salary -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Salary (USD)</label>
                                <input type="number" name="salary" value="{{ old('salary', $jobVacancy->salary) }}"
                                    class="mt-1 w-full rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200
                                    @error('salary') border-red-500 @else border-gray-300 @enderror"
                                    placeholder="e.g. 5000">
                                @error('salary')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Type -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Job Type</label>
                                <select name="type"
                                    class="mt-1 w-full rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200
                                    @error('type') border-red-500 @else border-gray-300 @enderror">
                                    <option value="">-- Select Type --</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}" {{ old('type', $jobVacancy->type) == $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Company -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Company</label>
                                <select name="companyId"
                                    class="mt-1 w-full rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200
                                    @error('companyId') border-red-500 @else border-gray-300 @enderror">
                                    <option value="">-- Select Company --</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('companyId', $jobVacancy->companyId) == $company->id ? 'selected' : '' }}>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('companyId')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Job Category</label>
                                <select name="categoryId"
                                    class="mt-1 w-full rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200
                                    @error('categoryId') border-red-500 @else border-gray-300 @enderror">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('categoryId', $jobVacancy->categoryId) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categoryId')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-600">Job Description</label>
                            <textarea name="description" rows="5"
                                class="mt-1 w-full rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200
                                @error('description') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Describe the role responsibilities...">{{ old('description', $jobVacancy->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-6 py-2 bg-indigo-500 text-white font-medium rounded-lg shadow hover:bg-indigo-600 transition">
                            Save
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
