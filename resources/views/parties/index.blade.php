<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Political Parties') }}
            </h2>
            <a href="{{ route('parties.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add New Party
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($parties->isEmpty())
                <div class="bg-white p-6 shadow rounded text-center text-gray-500">
                    No parties registered yet.
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($parties as $party)
                        <div class="bg-white border rounded-lg shadow p-4 hover:shadow-lg transition duration-200">
                            @if($party->logo)
                                <div class="w-full h-32 flex items-center justify-center mb-4">
                                    <img src="{{ asset('storage/' . $party->logo) }}" alt="{{ $party->name }} Logo" class="h-20 object-contain">
                                </div>
                            @endif

                            <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $party->name }}</h3>
                            <p class="text-sm text-gray-600 mb-1">Leader: <strong>{{ $party->leader_name ?? '—' }}</strong></p>
                            <p class="text-sm text-gray-600 mb-1">Founded: {{ $party->foundation_year ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500 mt-2 italic">
                                {{ $party->slogan ?? 'No slogan available.' }}
                            </p>

                            <div class="flex justify-between items-center mt-4 text-sm">
                                <a href="{{ route('parties.show', $party->id) }}" class="text-blue-600 hover:underline">View</a>
                                <a href="{{ route('parties.edit', $party->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('parties.destroy', $party->id) }}" method="POST" onsubmit="return confirm('Delete this party?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
