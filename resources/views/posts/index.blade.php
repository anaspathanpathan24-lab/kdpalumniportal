<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Knowledge Feed & Challenge Board') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Success Message -->
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            <!-- Create Post Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Create a Post or Challenge</h3>
                
                <form method="POST" action="{{ route('posts.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="type" :value="__('Post Type')" />
                        <select id="type" name="type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                            <option value="knowledge">Knowledge Feed (Discussion / Question)</option>
                            <option value="challenge">Challenge Board (Coding / Puzzle)</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('type')" />
                    </div>

                    <div>
                        <x-input-label for="title" :value="__('Title (Optional)')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" placeholder="e.g. Best practices for Laravel scaling or Coding Puzzle #1" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="body" :value="__('Content / Details (Markdown Supported)')" />
                        <textarea id="body" name="body" rows="4" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Use Markdown for code blocks like ```php ... ```" required></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('body')" />
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>{{ __('Publish Post') }}</x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Feed Filter Tabs -->
            <div class="flex gap-4">
                <a href="{{ route('posts.index') }}" class="px-4 py-2 rounded-md font-semibold text-sm {{ request('type') ? 'bg-white text-gray-700 shadow-sm' : 'bg-indigo-600 text-white' }}">
                    All Posts
                </a>
                <a href="{{ route('posts.index', ['type' => 'knowledge']) }}" class="px-4 py-2 rounded-md font-semibold text-sm {{ request('type') === 'knowledge' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 shadow-sm' }}">
                    Knowledge Feed
                </a>
                <a href="{{ route('posts.index', ['type' => 'challenge']) }}" class="px-4 py-2 rounded-md font-semibold text-sm {{ request('type') === 'challenge' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 shadow-sm' }}">
                    Challenge Board
                </a>
            </div>

            <!-- Feed List -->
            <div class="space-y-4">
                @forelse ($posts as $post)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs font-semibold uppercase px-2 py-1 rounded {{ $post->type === 'challenge' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $post->type }}
                            </span>
                            <span class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                        </div>

                        @if($post->title)
                            <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $post->title }}</h4>
                        @endif

                        <div class="text-gray-700 prose max-w-none mb-4">
                            {!! Str::markdown($post->body) !!}
                        </div>

                        <div class="text-sm text-gray-500 border-t pt-3 flex justify-between items-center">
                            <span>Posted by: <strong class="text-gray-700">{{ $post->user->name }}</strong> ({{ optional($post->user->profile)->current_company ?? 'Alumni' }})</span>
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                        No posts found in the feed yet. Be the first to share something!
                    </div>
                @endforelse

                <div class="mt-4">
                    {{ $posts->appends(request()->query())->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>