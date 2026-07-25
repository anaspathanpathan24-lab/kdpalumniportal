<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Diploma-to-Degree Navigator (Mentorship)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            <!-- Offer Mentorship Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ $userListing ? 'Update Your Mentorship Profile' : 'Offer Mentorship to Students' }}</h3>
                
                <form method="POST" action="{{ route('mentorship.store') }}" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="title" :value="__('Mentorship Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" placeholder="e.g. Diploma to B.Tech Guidance" value="{{ old('title', $userListing->title ?? '') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="expertise_areas" :value="__('Areas of Expertise')" />
                            <x-text-input id="expertise_areas" name="expertise_areas" type="text" class="mt-1 block w-full" placeholder="e.g. Mechanical Eng, Resume Review, GTU process" value="{{ old('expertise_areas', $userListing->expertise_areas ?? '') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('expertise_areas')" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('How can you help? (Bio / Description)')" />
                        <textarea id="description" name="description" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>{{ old('description', $userListing->description ?? '') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="block mt-4">
                        <label for="is_available" class="inline-flex items-center">
                            <input id="is_available" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_available" value="1" {{ old('is_available', $userListing->is_available ?? true) ? 'checked' : '' }}>
                            <span class="ms-2 text-sm text-gray-600">{{ __('I am currently available to take on mentees.') }}</span>
                        </label>
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>{{ $userListing ? __('Update Profile') : __('Become a Mentor') }}</x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Available Mentors List -->
            <div class="space-y-4 mt-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Available Mentors</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($mentors as $mentor)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-t-4 border-indigo-500 flex flex-col justify-between">
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-1">{{ $mentor->user->name }}</h4>
                                <p class="text-sm font-semibold text-indigo-600 mb-3">{{ $mentor->title }}</p>
                                
                                <div class="mb-4">
                                    <span class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Expertise:</span>
                                    <p class="text-sm text-gray-700 mt-1">{{ $mentor->expertise_areas }}</p>
                                </div>
                                
                                <p class="text-sm text-gray-600 italic">"{{ Str::limit($mentor->description, 120) }}"</p>
                            </div>

                            <div class="mt-6 pt-4 border-t flex justify-between items-center">
                                <span class="text-xs text-gray-500">
                                    {{ optional($mentor->user->profile)->current_company ?? 'Alumni' }}
                                </span>
                                
                                <a href="mailto:{{ $mentor->user->email }}" class="inline-flex items-center px-3 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">
                                    Contact
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-1 md:col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                            No mentors are currently available. Be the first to step up and guide others!
                        </div>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $mentors->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>