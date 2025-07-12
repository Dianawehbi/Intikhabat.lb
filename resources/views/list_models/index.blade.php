<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ __('Candidate Lists') }}</h1>
                <p class="text-sm text-gray-600">Browse all electoral lists with detailed candidate information</p>
            </div>
            <a href="{{ route('lists.create') }}" class="flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-800 text-white px-5 py-3 rounded-lg hover:shadow-lg transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Create New List
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filters Section -->
            <div class="bg-white p-6 rounded-xl shadow-sm mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Filter Lists</h3>
                <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="election" class="block text-sm font-medium text-gray-700 mb-1">Election</label>
                        <select id="election" name="election" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">All Elections</option>
                            @foreach($elections as $election)
                                <option value="{{ $election->id }}" {{ request('election') == $election->id ? 'selected' : '' }}>
                                    {{ $election->name }} ({{ $election->start_date }} - {{ $election->election_type }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="region" class="block text-sm font-medium text-gray-700 mb-1">Region</label>
                        <select id="region" name="region" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">All Regions</option>
                            @foreach(App\Enums\Region::cases() as $region)
                                <option value="{{ $region->value }}" {{ request('region') == $region->value ? 'selected' : '' }}>
                                    {{ $region->value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="flex items-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                            </svg>
                            Apply Filters
                        </button>
                        @if(request()->has('election') || request()->has('region'))
                            <a href="{{ route('lists.index') }}" class="ml-2 text-gray-600 hover:text-gray-900 text-sm flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            @if($lists->isEmpty())
                <div class="bg-white p-8 rounded-xl shadow-sm text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No lists found</h3>
                    <p class="mt-1 text-sm text-gray-500">Try adjusting your filters or create a new list.</p>
                </div>
            @else
                <!-- Grid Layout for Lists -->
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($lists as $list)
                        @php
                            // Dynamic colors based on party affiliation
                            $bgColor = $list->party ? 'bg-' . strtolower($list->party->name) . '-100' : 'bg-gray-100';
                            $borderColor = $list->party ? 'border-' . strtolower($list->party->name) . '-300' : 'border-gray-300';
                            $textColor = $list->party ? 'text-' . strtolower($list->party->name) . '-800' : 'text-gray-800';
                        @endphp

                        <div class="{{ $bgColor }} {{ $borderColor }} border-l-4 rounded-lg shadow-sm overflow-hidden flex flex-col h-full">
                            <div class="p-5 flex-grow">
                                <div class="flex flex-col gap-4">
                                    <div>
                                        <h3 class="text-xl font-bold {{ $textColor }}">{{ $list->name }}</h3>
                                        <div class="flex flex-wrap items-center gap-2 mt-2">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $bgColor }} {{ $textColor }}">
                                                {{ $list->election->name }} ({{ $list->election->start_date}})
                                            </span>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $list->electoral_district->region }} - {{ $list->electoral_district->name }}
                                            </span>
                                            @if($list->party)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $bgColor }} {{ $textColor }}">
                                                    {{ $list->party->name }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Candidates List -->
                                    <div class="mt-4 space-y-3">
                                        <h4 class="font-medium text-gray-900">Candidates ({{ $list->candidates->count() }})</h4>
                                        
                                        <div class="max-h-60 overflow-y-auto pr-2">
                                            @forelse($list->candidates as $candidate)
                                                <div class="flex items-start gap-3 p-2 bg-white rounded-lg border border-gray-200 hover:shadow transition mb-2">
                                                    <div class="flex-shrink-0">
                                                        @if($candidate->photo)
                                                            <img src="{{ asset('storage/' . $candidate->photo) }}" alt="{{ $candidate->full_name }}" class="h-10 w-10 rounded-full object-cover">
                                                        @else
                                                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="flex-grow">
                                                        <h5 class="text-sm font-medium text-gray-900">{{ $candidate->full_name }}</h5>
                                                        <p class="text-xs text-gray-600">{{ $candidate->position }}</p>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="text-center py-2 text-gray-500 text-sm">
                                                    No candidates in this list yet
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Footer with actions -->
                            <div class="px-5 py-3 bg-white border-t border-gray-200 flex justify-between items-center">
                                <a href="{{ route('lists.show', $list->id) }}" class="text-sm font-medium {{ $textColor }} hover:underline flex items-center gap-1">
                                    View details
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('lists.edit', $list->id) }}" class="text-gray-600 hover:text-yellow-600 p-1 rounded-full hover:bg-yellow-50" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('lists.destroy', $list->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this list?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-600 hover:text-red-600 p-1 rounded-full hover:bg-red-50" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if($lists->hasPages())
                    <div class="mt-8">
                        {{ $lists->withQueryString()->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>