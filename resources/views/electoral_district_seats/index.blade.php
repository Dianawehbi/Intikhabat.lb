<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Electoral Districts') }}
            </h2>
            <a href="{{ route('electoral_districts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add District
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-xl sm:rounded-lg">
                @if($electoralDistricts->isEmpty())
                    <p class="text-gray-500">No electoral districts found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100 text-left text-sm text-gray-600 uppercase tracking-wider">
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Region</th>
                                    <th class="px-4 py-2">Seats</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700">
                                @foreach($electoralDistricts as $district)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $district->name }}</td>
                                        <td class="px-4 py-2">{{ $district->region ?? '—' }}</td>
                                        <td class="px-4 py-2">{{ $district->seats_count ?? '—' }}</td>
                                        <td class="px-4 py-2 flex space-x-2">
                                            <a href="{{ route('electoral_districts.show', $district->id) }}" class="text-blue-600 hover:underline">View</a>
                                            <a href="{{ route('electoral_districts.edit', $district->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                            <form action="{{ route('electoral_districts.destroy', $district->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
