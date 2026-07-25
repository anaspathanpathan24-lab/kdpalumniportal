<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resource Vault (MOOCs & Exams)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            <!-- Upload Resource Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Share a Resource</h3>
                
                <form method="POST" action="{{ route('resources.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="title" :value="__('Resource Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" placeholder="e.g. 2023 Database Exam Paper" required />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="category" :value="__('Category')" />
                            <select id="category" name="category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                <option value="study_notes">Study Notes</option>
                                <option value="exam_paper">Exam Paper</option>
                                <option value="mooc">MOOC / Video Course</option>
                                <option value="other">Other Material</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('category')" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Brief Description (Optional)')" />
                        <textarea id="description" name="description" rows="2" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-t pt-4 mt-4">
                        <div>
                            <x-input-label for="url" :value="__('External URL (Optional)')" />
                            <x-text-input id="url" name="url" type="url" class="mt-1 block w-full" placeholder="e.g. https://youtube.com/..." />
                            <p class="text-xs text-gray-500 mt-1">For sharing external MOOCs or videos.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('url')" />
                        </div>

                        <div>
                            <x-input-label for="file" :value="__('Upload File (Optional)')" />
                            <input id="file" name="file" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <p class="text-xs text-gray-500 mt-1">PDF, DOC, ZIP (Max 10MB). For exams or notes.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('file')" />
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>{{ __('Upload Resource') }}</x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Category Filters -->
            <div class="flex gap-4 overflow-x-auto pb-2">
                <a href="{{ route('resources.index') }}" class="px-4 py-2 rounded-md font-semibold text-sm whitespace-nowrap {{ request('category') ? 'bg-white text-gray-700 shadow-sm' : 'bg-indigo-600 text-white' }}">All Resources</a>
                <a href="{{ route('resources.index', ['category' => 'study_notes']) }}" class="px-4 py-2 rounded-md font-semibold text-sm whitespace-nowrap {{ request('category') === 'study_notes' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 shadow-sm' }}">Study Notes</a>
                <a href="{{ route('resources.index', ['category' => 'exam_paper']) }}" class="px-4 py-2 rounded-md font-semibold text-sm whitespace-nowrap {{ request('category') === 'exam_paper' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 shadow-sm' }}">Exam Papers</a>
                <a href="{{ route('resources.index', ['category' => 'mooc']) }}" class="px-4 py-2 rounded-md font-semibold text-sm whitespace-nowrap {{ request('category') === 'mooc' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 shadow-sm' }}">MOOCs</a>
            </div>

            <!-- Resource Listings -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse ($resources as $resource)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs font-semibold uppercase px-2 py-1 rounded bg-blue-100 text-blue-800">
                                    {{ str_replace('_', ' ', $resource->category) }}
                                </span>
                                <span class="text-xs text-gray-500">{{ $resource->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <h4 class="text-lg font-bold text-gray-900 mb-1">{{ $resource->title }}</h4>
                            @if($resource->description)
                                <p class="text-sm text-gray-600 mb-4">{{ $resource->description }}</p>
                            @endif
                        </div>

                        <div class="mt-4 pt-4 border-t flex items-center justify-between">
                            <div class="text-xs text-gray-500">
                                By <strong class="text-gray-700">{{ $resource->user->name }}</strong>
                            </div>
                            
                            <div class="flex gap-2">
                                @if($resource->url)
                                    <a href="{{ $resource->url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-3 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">
                                        View Link
                                    </a>
                                @endif
                                
                                @if($resource->file_path)
                                    <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank" class="inline-flex items-center px-3 py-1 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 transition ease-in-out duration-150">
                                        Download File
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                        No resources found in this category. Be the first to share study material!
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $resources->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>