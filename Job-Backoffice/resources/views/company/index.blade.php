<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies') }} {{ request('archived') ? '(Archived)' : '' }}
        </h2>
    </x-slot>

<x-toast-notification />

    <div class="overflow-x-auto p-6">
        <div class="flex items-center justify-between">
            <div class="space-x-4">
                <a href="{{ route('company.index') }}"
                    class="px-4 py-2 rounded-md text-sm font-semibold
                            {{ request('archived') ? 'bg-gray-200 text-gray-600 hover:bg-gray-300' : 'bg-indigo-600 text-white' }}">
                    Active
                </a>
                <a href="{{ route('company.index', ['archived' => true]) }}"
                    class="px-4 py-2 rounded-md text-sm font-semibold
                            {{ request('archived') ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-600 hover:bg-gray-300' }}">
                    Archived
                </a>
            </div>
            @if (!request('archived'))
                <a href="{{ route('company.create') }}" class="flex items-center text-indigo-600 hover:text-indigo-900">
                    <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    <span class="font-semibold">Add company</span>
                </a>
            @endif
        </div>
        <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow mt-4 bg-white">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">company Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Address</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Industry</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Website</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companies as $company)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-800"><a href="{{ route('company.show', $company->id) }}" class="text-indigo-600 hover:text-indigo-900">{{ $company->name }}</a></td>
                        <td class="px-6 py-4 text-gray-800">{{ $company->address }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $company->industry }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $company->website }}</td>
                        <td class="px-6 py-4 flex items-center space-x-3">
                            @if(request('archived'))
                                <form action="{{ route('company.restore', $company->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="flex items-center text-green-600 hover:text-green-900">
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
                                <a href="{{ route('company.edit', $company) }}"
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

                                <form action="{{ route('company.destroy', $company) }}" method="POST" class="inline-block">
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
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-4 text-gray-800" colspan="2">
                            No job companies found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-6 flex justify-center">
            {{ $companies->links() }}
        </div>
    </div>
</x-app-layout>
