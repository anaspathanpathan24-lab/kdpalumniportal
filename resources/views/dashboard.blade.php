<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to KDP Alumni Portal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Notices Section -->
            @php
                $notices = \App\Models\Notice::where('is_active', true)->latest()->get();
            @endphp

            @if($notices->count() > 0)
                <div class="bg-indigo-50 border-l-4 border-indigo-600 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-bold text-indigo-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                        Official Announcements
                    </h3>
                    <div class="space-y-4">
                        @foreach($notices as $notice)
                            <div class="bg-white p-4 rounded shadow-sm border border-indigo-100">
                                <h4 class="font-bold text-gray-900">{{ $notice->title }}</h4>
                                <p class="text-sm text-gray-700 mt-1">{{ $notice->body }}</p>
                                <p class="text-xs text-gray-400 mt-2">Posted on {{ $notice->created_at->format('M d, Y') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in! Use the navigation menu to explore the Directory, Feed, and Job Board.") }}
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <a href="{{ route('id-card.show') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    View My Digital ID Card
                </a>
            </div>
        </div>
    </div>
</x-app-layout>