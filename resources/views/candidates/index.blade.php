<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Candidates List') }}
            </h2>
            @if (Auth::check() && Auth::user()->role === 'admin')
                <a href="{{ route('candidates.create') }}" 
                   class="px-4 py-2 bg-gradient-to-r from-green-600 to-green-800 text-white rounded-lg shadow hover:shadow-lg transition-all flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add Candidate
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Advanced Filters Card -->
            <div class="mb-8 bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        Filter Candidates
                    </h3>
                    <form method="GET" action="{{ route('candidates.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <!-- Region -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Region</label>
                            <select name="region" onchange="this.form.submit()" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50 transition">
                                <option value="">All Regions</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region }}" {{ ($filters['region'] ?? '') === $region ? 'selected' : '' }}>
                                        {{ $region }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Year -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                            <select name="year" onchange="this.form.submit()" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-white focus:ring focus:ring-green-200 focus:ring-opacity-50 transition">
                                <option value="">All Years</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ ($filters['year'] ?? '') == $year ? 'selected' : '' }}>{{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Election -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Election Type</label>
                            <select name="election_type" onchange="this.form.submit()" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-white focus:ring focus:ring-green-200 focus:ring-opacity-50 transition">
                            </select>
                        </div>

                        <!-- Party -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Political Party</label>
                            <select name="party_id" onchange="this.form.submit()" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-white focus:ring focus:ring-green-200 focus:ring-opacity-50 transition">
                                <option value="">All Parties</option>
                                @foreach ($parties as $party)
                                    <option value="{{ $party->id }}" {{ ($filters['party_id'] ?? '') == $party->id ? 'selected' : '' }}>
                                        {{ $party->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Reset Button -->
                        <div class="flex items-end">
                            <a href="{{ route('candidates.index') }}"
                                class="w-full px-4 py-2 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-lg shadow hover:shadow-md transition-all flex items-center justify-center border border-gray-300 hover:bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                </svg>
                                Reset Filters
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- District Grouping --}}
            @forelse ($districts as $district)
                <div class="mb-8 bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 transition-all hover:shadow-xl">
                    <div class="bg-gradient-to-r from-red-600 to-red-800 px-6 py-3">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            {{ $district->name }}
                            <span class="ml-2 text-sm font-normal text-red-100">({{ $district->region }})</span>
                        </h3>
                    </div>

                    @if ($district->candidates->isEmpty())
                        <div class="p-6 text-center">
                            <div class="text-gray-500 flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                No candidates in this district.
                            </div>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Candidate</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Sect</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Position</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Votes</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                                        @if (Auth::check() && Auth::user()->role === 'admin')
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($district->candidates as $candidate)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-red-100 to-green-100 flex items-center justify-center text-gray-600 font-bold">
                                                        {{ substr($candidate->full_name, 0, 1) }}
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $candidate->full_name }}</div>
                                                        <div class="text-sm text-gray-500">{{ $candidate->party->name ?? 'Independent' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $candidate->sect }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $candidate->position }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <div class="flex items-center">
                                                    {{ number_format($candidate->votes_count ?? 0) }}
                                                    @if($candidate->votes_count > 0)
                                                        <span class="ml-2 px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                            {{ round(($candidate->votes_count / $district->candidates->sum('votes_count')) * 100, 1) }}%
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $candidate->won ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $candidate->won ? 'Elected' : 'Not Elected' }}
                                                </span>
                                            </td>
                                            @if (Auth::check() && Auth::user()->role === 'admin')
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <div class="flex space-x-2">
                                                        <a href="{{ route('candidates.edit', $candidate) }}"
                                                            class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                            </svg>
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('candidates.destroy', $candidate) }}" method="POST"
                                                            class="inline-block" onsubmit="return confirm('Delete this candidate?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-900 flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                                </svg>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            @empty
                <div class="bg-white p-8 rounded-xl shadow-lg text-center border border-gray-100">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="mt-3 text-lg font-medium text-gray-900">No electoral districts found</h3>
                    <p class="mt-2 text-sm text-gray-500">There are no districts matching your current filters.</p>
                    <div class="mt-6">
                        <a href="{{ route('candidates.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Clear all filters
                        </a>
                    </div>
                </div>
            @endforelse

            <!-- Pagination -->
            {{-- @if($districts->hasPages())
                <div class="mt-8 bg-white px-6 py-4 rounded-lg shadow border border-gray-100">
                    {{ $districts->links() }}
                </div>
            @endif --}}
        </div>
    </div>
</x-app-layout>