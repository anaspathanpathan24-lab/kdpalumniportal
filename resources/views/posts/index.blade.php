<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alumni Directory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- Advanced Search & Filter Form -->
                <form method="GET" action="{{ route('alumni.index') }}" class="mb-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- General Keyword Search -->
                        <div>
                            <x-input-label for="search" :value="__('Keyword Search')" />
                            <x-text-input id="search" name="search" type="text" value="{{ request('search') }}" placeholder="Name, company, department..." class="mt-1 block w-full" />
                        </div>

                        <!-- Graduation Year Filter -->
                        <div>
                            <x-input-label for="graduation_year" :value="__('Graduation Year')" />
                            <x-text-input id="graduation_year" name="graduation_year" type="text" value="{{ request('graduation_year') }}" placeholder="e.g. 2024" class="mt-1 block w-full" />
                        </div>

                        <!-- Location Filter -->
                        <div>
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" name="location" type="text" value="{{ request('location') }}" placeholder="e.g. City or Country" class="mt-1 block w-full" />
                        </div>
                    </div>

                    <div class="flex justify-end gap-2">
                        @if(request()->hasAny(['search', 'graduation_year', 'location']))
                            <a href="{{ route('alumni.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Reset Filters') }}
                            </a>
                        @endif
                        <x-primary-button>
                            {{ __('Filter Directory') }}
                        </x-primary-button>
                    </div>
                </form>

                <!-- Alumni List Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Degree / Dept</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company / Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grad Year</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($alumni as $person)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $person->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ optional($person->profile)->degree ?? 'N/A' }} - {{ optional($person->profile)->department ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ optional($person->profile)->job_title ?? 'N/A' }} at {{ optional($person->profile)->current_company ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ optional($person->profile)->location ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ optional($person->profile)->graduation_year ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No alumni matching your filter criteria found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $alumni->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>