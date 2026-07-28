@extends('layouts.app')

@section('content')
    <!-- Rich Hero Banner with Image & Gradient Overlay -->
    <div class="relative w-full h-80 flex items-center justify-center overflow-hidden shadow-md">
        <img src="https://picsum.photos/id/1012/1920/600" class="absolute inset-0 w-full h-full object-cover" alt="Mentorship Background">
        <div class="absolute inset-0 bg-gradient-to-r from-[#8b0000] via-[#8b0000]/90 to-gray-900/80"></div>
        
        <div class="relative z-10 text-center text-white px-4 mt-8">
            <h1 class="font-serif text-3xl md:text-5xl font-bold mb-4 tracking-wide">Mentorship Program</h1>
            <p class="text-sm md:text-lg font-light text-gray-200 max-w-3xl mx-auto">
                Reconnect with your batchmates, guide the next generation of students, or find an experienced mentor to help navigate your career.
            </p>
            
            <div class="mt-8 flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="#mentor-directory" class="bg-white text-[#8b0000] text-sm font-bold py-3 px-8 rounded-sm shadow-md hover:bg-gray-100 transition-colors w-full sm:w-auto text-center">
                    Find a Mentor
                </a>
                <a href="#mentor-form" class="bg-transparent border border-white text-white text-sm font-bold py-3 px-8 rounded-sm shadow-md hover:bg-white/10 transition-colors w-full sm:w-auto text-center">
                    {{ $userListing ? 'Update Your Profile' : 'Apply to be a Mentor' }}
                </a>
            </div>
        </div>
    </div>

    <!-- Success Message Alert -->
    @if (session('status'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 relative z-20">
            <div class="p-4 bg-green-50 border-l-4 border-green-500 text-green-700 text-sm rounded shadow-sm flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                {{ session('status') }}
            </div>
        </div>
    @endif

    <!-- Main Content Area: Mentor Directory -->
    <div id="mentor-directory" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-16 relative z-20">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-8 border-b border-gray-200 pb-4">
            <div class="mb-4 md:mb-0">
                <h2 class="font-serif text-3xl font-bold text-gray-900">Featured Mentors</h2>
                <p class="text-gray-600 mt-1 text-sm">Connect with experienced alumni across diverse industries.</p>
            </div>
        </div>

        <!-- Mentor Grid (Populated from Database) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            @forelse($mentors as $listing)
                <!-- Mentor Card -->
                <div class="bg-white rounded-sm shadow-md border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                    
                    <!-- Cover Image -->
                    <div class="h-24 bg-gray-200 relative w-full">
                        <img src="https://picsum.photos/id/{{ 1040 + $loop->index }}/400/150" class="w-full h-full object-cover opacity-80" alt="Cover">
                    </div>
                    
                    <!-- Card Body -->
                    <div class="px-6 pb-6 relative flex-grow flex flex-col">
                        
                        <!-- Profile Avatar (Isolated in its own absolute container) -->
                        <div class="absolute -top-10 left-6">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($listing->user->name) }}&color=8b0000&background=f3f4f6&size=128" class="w-20 h-20 rounded-full border-4 border-white shadow-sm bg-white object-cover" alt="Mentor Profile">
                        </div>
                        
                        <!-- Text Content (Padding top ensures it clears the avatar) -->
                        <div class="pt-14 flex-grow flex flex-col">
                            <h3 class="font-bold text-lg text-gray-900 truncate">{{ $listing->user->name }}</h3>
                            <p class="text-sm text-[#8b0000] font-semibold mb-1 line-clamp-1">{{ $listing->title }}</p>
                            
                            <p class="text-xs text-gray-500 mb-4 border-b border-gray-100 pb-4">
                                {{ $listing->user->department ?? 'Alumni' }} 
                                @if($listing->user->graduation_year)
                                    | Class of {{ $listing->user->graduation_year }}
                                @endif
                            </p>
                            
                            <!-- Expertise Tags -->
                            <div class="mb-6 h-12 overflow-hidden flex-grow">
                                <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-2">Expertise In:</span>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach(explode(',', $listing->expertise_areas) as $tag)
                                        <span class="bg-gray-50 border border-gray-200 text-gray-700 text-[11px] px-2 py-0.5 rounded-sm shadow-sm truncate max-w-full">{{ trim($tag) }}</span>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Action Button pushed to bottom -->
                            <div class="mt-auto pt-2">
                                <a href="#" class="block text-center w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm font-bold py-2 rounded-sm hover:bg-[#8b0000] hover:border-[#8b0000] hover:text-white transition-colors">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500 font-medium">No mentors available at the moment. Be the first to join!</p>
                </div>
            @endforelse

        </div>

        <!-- Pagination Links -->
        <div class="mt-8">
            {{ $mentors->links() }}
        </div>
    </div>

    <!-- ============================================== -->
    <!-- BECOME A MENTOR FORM SECTION                   -->
    <!-- ============================================== -->
    <div class="bg-gray-50 border-t border-gray-200 pb-20">
        <div id="mentor-form" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            
            <div class="bg-white rounded-sm shadow-xl p-8 md:p-12 border-t-4 border-[#8b0000]">
                <h2 class="font-serif text-3xl font-bold text-brand-navy mb-2">
                    {{ $userListing ? 'Manage Your Mentorship Profile' : 'Become a Mentor' }}
                </h2>
                <p class="text-sm text-gray-600 mb-8 pb-4 border-b border-gray-200">
                    Share your experience and guide students or fellow alumni. Fill out the details below to list yourself in the directory.
                </p>

                <form method="POST" action="{{ route('mentorship.store') }}" class="space-y-6">
                    @csrf

                    <!-- Professional Title -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Professional Title / Current Role <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $userListing->title ?? '') }}" placeholder="e.g. Senior Software Engineer at Google" required class="w-full border border-gray-300 rounded-sm shadow-sm py-2 px-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#8b0000] focus:border-[#8b0000] text-sm">
                        @error('title') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Expertise Areas -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Areas of Expertise <span class="text-red-500">*</span></label>
                        <input type="text" name="expertise_areas" value="{{ old('expertise_areas', $userListing->expertise_areas ?? '') }}" placeholder="e.g. Machine Learning, Interview Prep, Career Transition" required class="w-full border border-gray-300 rounded-sm shadow-sm py-2 px-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#8b0000] focus:border-[#8b0000] text-sm">
                        <span class="text-xs text-gray-500 mt-1 block">Separate multiple areas with commas.</span>
                        @error('expertise_areas') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Mentorship Description <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="4" required placeholder="Describe how you can help mentees, your background, and what topics you are open to discussing..." class="w-full border border-gray-300 rounded-sm shadow-sm py-2 px-3 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#8b0000] focus:border-[#8b0000] text-sm">{{ old('description', $userListing->description ?? '') }}</textarea>
                        @error('description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Availability Checkbox -->
                    <div class="pt-2">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="is_available" value="1" {{ old('is_available', $userListing->is_available ?? false) ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-[#8b0000] border-gray-300 rounded-sm focus:ring-[#8b0000]">
                            <span class="text-sm font-semibold text-gray-800">I am currently available to take new mentees.</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <button type="submit" class="w-full md:w-auto bg-[#8b0000] hover:bg-[#6b0d0d] text-white font-bold py-3 px-8 rounded-sm shadow-md transition-colors text-sm">
                            {{ $userListing ? 'Update Mentorship Profile' : 'Submit Mentorship Profile' }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection