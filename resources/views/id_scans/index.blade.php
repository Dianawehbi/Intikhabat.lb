<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('ID Scans') }}
            </h2>
            <a href="{{ route('id_scans.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Upload New ID
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-xl sm:rounded-lg">
                @if($idScans->isEmpty())
                    <p class="text-gray-500">No ID scans uploaded yet.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100 text-left text-sm text-gray-600 uppercase tracking-wider">
                                    <th class="px-4 py-2">Voter Name</th>
                                    <th class="px-4 py-2">Scan Preview</th>
                                    <th class="px-4 py-2">Uploaded At</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700">
                                @foreach($idScans as $scan)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $scan->voter->full_name ?? '—' }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ asset('storage/' . $scan->file_path) }}" target="_blank" class="text-blue-600 hover:underline">
                                                View File
                                            </a>
                                        </td>
                                        <td class="px-4 py-2">{{ $scan->created_at->format('Y-m-d H:i') }}</td>
                                        <td class="px-4 py-2 flex space-x-2">
                                            <a href="{{ route('id_scans.show', $scan->id) }}" class="text-blue-600 hover:underline">View</a>
                                            <a href="{{ route('id_scans.edit', $scan->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                            <form action="{{ route('id_scans.destroy', $scan->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
