<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Electoral District Seats') }}
            </h2>
            <a href="{{ route('electoral_district_seats.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add Seat
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-xl sm:rounded-lg">
                @if($seats->isEmpty())
                    <p class="text-gray-500">No seats found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100 text-left text-sm text-gray-600 uppercase tracking-wider">
                                    <th class="px-4 py-2">District</th>
                                    <th class="px-4 py-2">Sect</th>
                                    <th class="px-4 py-2">Seat Title</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700">
                                @foreach($seats as $seat)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $seat->electoralDistrict->name ?? '—' }}</td>
                                        <td class="px-4 py-2">{{ $seat->sect ?? '—' }}</td>
                                        <td class="px-4 py-2">{{ $seat->title ?? '—' }}</td>
                                        <td class="px-4 py-2 flex space-x-2">
                                            <a href="{{ route('electoral_district_seats.show', $seat->id) }}" class="text-blue-600 hover:underline">View</a>
                                            <a href="{{ route('electoral_district_seats.edit', $seat->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                            <form action="{{ route('electoral_district_seats.destroy', $seat->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
