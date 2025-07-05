@props(['post'])

<section class="relative">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <!-- Featured Post Content -->
        <div class="order-2 lg:order-1">
            <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-4">
                <a href="{{ route('category.show', $post->category->slug) }}" class="hover:text-blue-900">
                    {{ $post->category->name }}
                </a>
            </div>
            <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-blue-600">
                    {{ $post->title }}
                </a>
            </h1>
            <p class="text-lg text-gray-600 mb-6">
                {{ $post->excerpt }}
            </p>
            <div class="flex items-center text-sm text-gray-500 mb-6">
                <span>By {{ $post->user->name }}</span>
                <span class="mx-2">•</span>
                <time datetime="{{ $post->created_at->toISOString() }}">
                    {{ $post->created_at->format('M d, Y') }}
                </time>
            </div>
            <a href="{{ route('posts.show', $post->slug) }}" 
               class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">
                Read More
                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

        <!-- Featured Post Image -->
        <div class="order-1 lg:order-2">
            @if($post->featured_image)
                <img src="{{ Storage::url($post->featured_image) }}" 
                     alt="{{ $post->title }}"
                     class="w-full h-64 lg:h-80 object-cover rounded-lg shadow-lg">
            @else
                <div class="w-full h-64 lg:h-80 bg-gray-200 rounded-lg shadow-lg flex items-center justify-center">
                    <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            @endif
        </div>
    </div>
</section>
