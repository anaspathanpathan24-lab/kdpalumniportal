<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Local Apprenticeship & Job Board') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            <!-- Post a Job Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Post a New Opportunity</h3>
                
                <form method="POST" action="{{ route('jobs.store') }}" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="title" :value="__('Job Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" placeholder="e.g. Junior Developer" required />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="company" :value="__('Company Name')" />
                            <x-text-input id="company" name="company" type="text" class="mt-1 block w-full" placeholder="e.g. GIDC Tech Solutions" required />
                            <x-input-error class="mt-2" :messages="$errors->get('company')" />
                        </div>

                        <div>
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" placeholder="e.g. Mehsana, Remote" />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>

                        <div>
                            <x-input-label for="employment_type" :value="__('Employment Type')" />
                            <select id="employment_type" name="employment_type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                <option value="full-time">Full-time</option>
                                <option value="part-time">Part-time</option>
                                <option value="apprenticeship">Apprenticeship</option>
                                <option value="internship">Internship</option>
                                <option value="contract">Contract</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('employment_type')" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="application_link_or_email" :value="__('Application Link or Email')" />
                        <x-text-input id="application_link_or_email" name="application_link_or_email" type="text" class="mt-1 block w-full" placeholder="e.g. hr@company.com or https://company.com/apply" />
                        <x-input-error class="mt-2" :messages="$errors->get('application_link_or_email')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Job Description (Markdown Supported)')" />
                        <textarea id="description" name="description" rows="4" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>{{ __('Post Opportunity') }}</x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Job Listings code here -->
            <div class="space-y-4">
                <h3 class="text-lg font-medium text-gray-900 mt-8 mb-4">Latest Opportunities</h3>
                
                @forelse ($jobs as $job)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-indigo-500">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-4">
                            <div>
                                <h4 class="text-xl font-bold text-gray-900">{{ $job->title }}</h4>
                                <p class="text-md font-semibold text-gray-600">{{ $job->company }}</p>
                            </div>
                            <div class="mt-2 md:mt-0 flex gap-2">
                                <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded border border-gray-200">
                                    {{ ucfirst(str_replace('-', ' ', $job->employment_type)) }}
                                </span>
                                @if($job->location)
                                    <span class="bg-blue-50 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded border border-blue-200">
                                        📍 {{ $job->location }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="text-gray-700 prose max-w-none mb-4">
                            {!! Str::markdown($job->description) !!}
                        </div>

                        <div class="border-t pt-4 flex flex-col md:flex-row justify-between items-center gap-4">
                            <div class="text-sm text-gray-500">
                                Posted by: <strong class="text-gray-700">{{ $job->user->name }}</strong> • {{ $job->created_at->diffForHumans() }}
                            </div>
                            
                            @if($job->application_link_or_email)
                                @if(filter_var($job->application_link_or_email, FILTER_VALIDATE_EMAIL))
                                    <a href="mailto:{{ $job->application_link_or_email }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Email to Apply
                                    </a>
                                @else
                                    <a href="{{ str_starts_with($job->application_link_or_email, 'http') ? $job->application_link_or_email : 'https://'.$job->application_link_or_email }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Apply Now
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                        No jobs posted yet. Have an open role at your company? Post it here!
                    </div>
                @endforelse

                <div class="mt-4">
                    {{ $jobs->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
