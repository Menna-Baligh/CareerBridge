<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit User Password
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 space-y-6">
        <!-- User Info -->
        <div class="bg-purple-50 shadow rounded-lg p-6 border border-purple-200">
            <h3 class="text-lg font-semibold mb-4 text-purple-700">User Details</h3>

            <div class="divide-y divide-purple-100">
                <div class="flex justify-between py-2">
                    <span class="text-sm text-gray-600">Name</span>
                    <span class="font-medium text-gray-900">{{ $user->name }}</span>
                </div>
                <div class="flex justify-between py-2">
                    <span class="text-sm text-gray-600">Email</span>
                    <span class="font-medium text-gray-900">{{ $user->email }}</span>
                </div>
                <div class="flex justify-between py-2">
                    <span class="text-sm text-gray-600">Role</span>
                    <span class="font-medium text-gray-900">{{ $user->role }}</span>
                </div>
                <div class="flex justify-between py-2">
                    <span class="text-sm text-gray-600">Joined At</span>
                    <span class="font-medium text-gray-900">{{ $user->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

        <!-- Password Update Form -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Change Password</h3>

            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-600">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="mt-1 w-full rounded-lg shadow-sm
                            focus:border-purple-400 focus:ring focus:ring-purple-200
                            @error('password') border-red-500 @else border-gray-300 @enderror"
                    >
                    @error('password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-600">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="mt-1 w-full rounded-lg border-gray-300 shadow-sm
                                focus:border-purple-400 focus:ring focus:ring-purple-200"
                    >
                </div>

                <!-- Actions -->
                <div class="flex justify-end mt-6">
                    <a
                        href="{{ route('user.index') }}"
                        class="mr-3 px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300"
                    >
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg shadow bg-purple-600 text-white hover:bg-purple-700"
                    >
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
