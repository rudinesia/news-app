@extends('layouts.public')

@section('title', config('app.name') . ' - Latest News')
@section('description', 'Stay updated with the latest news and articles from ' . config('app.name'))

@section('content')
<div class="space-y-12">
    <!-- Hero Section -->
    @if($posts->count() > 0)
        @php $featuredPost = $posts->first(); @endphp
        <section class="relative">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <!-- Featured Post Content -->
                <div class="order-2 lg:order-1">
                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-4">
                        {{ $featuredPost->category->name }}
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                        <a href="{{ route('posts.show', $featuredPost->slug) }}" class="hover:text-blue-600">
                            {{ $featuredPost->title }}
                        </a>
                    </h1>
                    <p class="text-lg text-gray-600 mb-6">
                        {{ $featuredPost->excerpt }}
                    </p>
                    <div class="flex items-center text-sm text-gray-500 mb-6">
                        <span>By {{ $featuredPost->user->name }}</span>
                        <span class="mx-2">•</span>
                        <time datetime="{{ $featuredPost->created_at->toISOString() }}">
                            {{ $featuredPost->created_at->format('M d, Y') }}
                        </time>
                    </div>
                    <a href="{{ route('posts.show', $featuredPost->slug) }}" 
                       class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">
                        Read More
                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Featured Post Image -->
                <div class="order-1 lg:order-2">
                    @if($featuredPost->featured_image)
                        <img src="{{ Storage::url($featuredPost->featured_image) }}" 
                             alt="{{ $featuredPost->title }}"
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
    @endif

    <!-- Latest Posts -->
    <section>
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Latest News</h2>
        </div>

        @if($posts->count() > 1)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts->skip(1) as $post)
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <!-- Post Image -->
                        <div class="aspect-w-16 aspect-h-9">
                            @if($post->featured_image)
                                <img src="{{ Storage::url($post->featured_image) }}" 
                                     alt="{{ $post->title }}"
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Post Content -->
                        <div class="p-6">
                            <!-- Category -->
                            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-3">
                                {{ $post->category->name }}
                            </div>

                            <!-- Title -->
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-blue-600">
                                    {{ $post->title }}
                                </a>
                            </h3>

                            <!-- Excerpt -->
                            <p class="text-gray-600 mb-4">
                                {{ Str::limit($post->excerpt, 120) }}
                            </p>

                            <!-- Meta -->
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>By {{ $post->user->name }}</span>
                                <time datetime="{{ $post->created_at->toISOString() }}">
                                    {{ $post->created_at->format('M d, Y') }}
                                </time>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($posts->hasPages())
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @endif
        @elseif($posts->count() == 0)
            <!-- Empty State -->
            <div class="text-center py-16">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No posts available</h3>
                <p class="text-gray-600">Check back later for the latest news and updates.</p>
            </div>
        @endif
    </section>

    <!-- Categories Section -->
    @if($categories->count() > 0)
        <section class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Browse by Category</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}" 
                       class="group p-4 border border-gray-200 rounded-lg hover:border-blue-300 hover:shadow-md transition duration-300">
                        <div class="text-center">
                            <h3 class="font-medium text-gray-900 group-hover:text-blue-600 mb-1">
                                {{ $category->name }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ $category->posts_count }} {{ Str::plural('post', $category->posts_count) }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
