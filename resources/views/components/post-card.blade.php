@props([
    'post',
    'showExcerpt' => true,
    'excerptLimit' => 120,
    'imageHeight' => 'h-48',
    'showCategory' => true,
    'showMeta' => true
])

<article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
    <!-- Post Image -->
    <div class="aspect-w-16 aspect-h-9">
        @if($post->featured_image)
            <img src="{{ Storage::url($post->featured_image) }}" 
                 alt="{{ $post->title }}"
                 class="w-full {{ $imageHeight }} object-cover">
        @else
            <div class="w-full {{ $imageHeight }} bg-gray-200 flex items-center justify-center">
                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        @endif
    </div>

    <!-- Post Content -->
    <div class="p-6">
        @if($showCategory)
            <!-- Category -->
            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-3">
                <a href="{{ route('category.show', $post->category->slug) }}" class="hover:text-blue-900">
                    {{ $post->category->name }}
                </a>
            </div>
        @endif

        <!-- Title -->
        <h3 class="text-lg font-semibold text-gray-900 mb-2">
            <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-blue-600">
                {{ $post->title }}
            </a>
        </h3>

        @if($showExcerpt)
            <!-- Excerpt -->
            <p class="text-gray-600 mb-4">
                {{ Str::limit($post->excerpt, $excerptLimit) }}
            </p>
        @endif

        @if($showMeta)
            <!-- Meta -->
            <div class="flex items-center justify-between text-sm text-gray-500">
                <span>By {{ $post->user->name }}</span>
                <time datetime="{{ $post->created_at->toISOString() }}">
                    {{ $post->created_at->format('M d, Y') }}
                </time>
            </div>
        @endif
    </div>
</article>
