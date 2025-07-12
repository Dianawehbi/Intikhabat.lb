<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Votes') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-xl sm:rounded-lg">
                @if($votes->isEmpty())
                    <p class="text-gray-500">No votes recorded.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100 text-left text-sm text-gray-600 uppercase tracking-wider">
                                    <th class="px-4 py-2">Voter</th>
                                    <th class="px-4 py-2">Candidate</th>
                                    <th class="px-4 py-2">Election</th>
                                    <th class="px-4 py-2">District</th>
                                    <th class="px-4 py-2">Voted At</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700">
                                @foreach($votes as $vote)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $vote->voter->full_name ?? '—' }}</td>
                                        <td class="px-4 py-2">{{ $vote->candidate->full_name ?? '—' }}</td>
                                        <td class="px-4 py-2">{{ $vote->election->title ?? '—' }}</td>
                                        <td class="px-4 py-2">{{ $vote->electoralDistrict->name ?? '—' }}</td>
                                        <td class="px-4 py-2">{{ $vote->created_at->format('Y-m-d H:i') }}</td>
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
