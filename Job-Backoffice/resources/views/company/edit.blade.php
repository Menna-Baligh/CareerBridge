<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('company.index') }}"
            class="px-3 py-1 bg-gray-200 hover:bg-gray-300 text-sm rounded-lg">
                ← Back
            </a>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Company - {{ $company->name }}
            </h2>
        </div>
    </x-slot>

    <x-toast-notification />

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-2xl p-8">

                <form action="{{ route('company.update', ['company' => $company->id, 'redirectToShow'=>request('redirectToShow')]) }}" method="POST" class="space-y-10">
                    @csrf
                    @method('PUT')
                    <!-- Company Info -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-700 border-b pb-2 mb-6">Company Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Company Name</label>
                                <input type="text" name="name" value="{{ old('name', $company->name) }}"
                                    class="mt-1 w-full rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200
                                    @error('name') border-red-500 @else border-gray-300 @enderror"
                                    placeholder="e.g. Tech Solutions Ltd">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Address</label>
                                <input type="text" name="address" value="{{ old('address', $company->address) }}"
                                    class="mt-1 w-full rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200
                                    @error('address') border-red-500 @else border-gray-300 @enderror"
                                    placeholder="e.g. 123 Main St, Cairo">
                                @error('address')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Industry -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Industry</label>
                                <select name="industry"
                                    class="mt-1 w-full rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200
                                    @error('industry') border-red-500 @else border-gray-300 @enderror">
                                    <option value="">-- Select Industry --</option>
                                    @foreach ($industries as $industry)
                                        <option value="{{ $industry }}" {{ old('industry', $company->industry) == $industry ? 'selected' : '' }}>
                                            {{ $industry }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('industry')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Website -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Website (optional)</label>
                                <input type="url" name="website" value="{{ old('website', $company->website) }}"
                                    class="mt-1 w-full rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200
                                    @error('website') border-red-500 @else border-gray-300 @enderror"
                                    placeholder="https://example.com">
                                @error('website')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Owner Info -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-700 border-b pb-2 mb-6">Owner Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Owner Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Owner Name</label>
                                <input type="text" name="owner_name" value="{{ old('owner_name', $company->owner->name) }}"
                                    class="mt-1 w-full rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200
                                    @error('owner_name') border-red-500 @else border-gray-300 @enderror"
                                    placeholder="e.g. Menna Baligh">
                                @error('owner_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Owner Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Owner Email</label>
                                <input disabled type="email" name="owner_email" value="{{ old('owner_email', $company->owner->email) }}"
                                    class="mt-1 w-full rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 bg-gray-100
                                    @error('owner_email') border-red-500 @else border-gray-300 @enderror"
                                    placeholder="owner@example.com">
                                @error('owner_email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Change Owner Password (leave blank to keep the same)</label>
                                <input type="password" name="password"
                                    class="mt-1 w-full rounded-lg shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200
                                    @error('password') border-red-500 @else border-gray-300 @enderror"
                                    >
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>


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
