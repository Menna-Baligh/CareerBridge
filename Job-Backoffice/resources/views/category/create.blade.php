<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Job Category') }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto p-6">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8">

            <h3 class="text-lg font-semibold text-gray-800 mb-6">Add a new category</h3>

            <form action="{{ route('category.store') }}" method="post">
                @csrf

                <!-- Category Name -->
                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Category Name
                    </label>
                    <input type="text" name="name" id="name"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                        @error('name') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                        value="{{ old('name') }}" placeholder="Enter category name">

                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('category.index') }}"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2 bg-indigo-600 text-white rounded-lg font-semibold shadow hover:bg-indigo-700 transition">
                        Add Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
