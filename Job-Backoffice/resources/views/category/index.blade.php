<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Categories') }}
        </h2>
    </x-slot>
    
<x-toast-notification />

    <div class="overflow-x-auto p-6">
        <div class="flex items-center justify-end">
            <a href="{{ route('category.create') }}" class="flex items-center text-indigo-600 hover:text-indigo-900">
                <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                <span class="font-semibold">Add Category</span>
            </a>
        </div>
        <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow mt-4 bg-white">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Category Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobCategories as $jobCategory)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-800">{{ $jobCategory->name }}</td>
                        <td class="px-6 py-4 flex items-center space-x-3">
                            <!-- Edit button -->
                            <a href="{{ route('category.edit', $jobCategory) }}"
                                class="flex items-center text-indigo-600 hover:text-indigo-900">
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

                            <form action="{{ route('category.destroy', $jobCategory) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="flex items-center text-red-600 hover:text-red-900">
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 flex justify-center">
            {{ $jobCategories->links() }}
        </div>
    </div>
</x-app-layout>
