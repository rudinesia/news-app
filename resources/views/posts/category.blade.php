@extends('layouts.public')

@section('title', $category->name . ' - ' . config('app.name'))
@section('description', $category->description ?: 'Browse all articles in ' . $category->name . ' category')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <nav>
        <ol class="flex items-center space-x-2 text-sm text-gray-500">
            <li>
                <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
            </li>
            <li>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </li>
            <li class="text-gray-900">{{ $category->name }}</li>
        </ol>
    </nav>

    <!-- Category Header -->
    <header class="text-center py-8 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
            {{ $category->name }}
        </h1>
        @if($category->description)
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                {{ $category->description }}
            </p>
        @endif
        <div class="mt-4">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                {{ $posts->total() }} {{ Str::plural('article', $posts->total()) }}
            </span>
        </div>
    </header>

    <!-- Posts Grid -->
    @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
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
                        <!-- Title -->
                        <h2 class="text-xl font-semibold text-gray-900 mb-3">
                            <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-blue-600">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <!-- Excerpt -->
                        <p class="text-gray-600 mb-4">
                            {{ Str::limit($post->excerpt, 150) }}
                        </p>

                        <!-- Meta -->
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center">
                                <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center mr-2">
                                    <span class="text-white text-xs font-medium">
                                        {{ substr($post->user->name, 0, 1) }}
                                    </span>
                                </div>
                                <span>{{ $post->user->name }}</span>
                            </div>
                            <time datetime="{{ $post->created_at->toISOString() }}">
                                {{ $post->created_at->format('M d, Y') }}
                            </time>
                        </div>

                        <!-- Read More -->
                        <div class="mt-4">
                            <a href="{{ route('posts.show', $post->slug) }}" 
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                Read More
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
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
    @else
        <!-- Empty State -->
        <div class="text-center py-16 bg-white rounded-lg shadow-md">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="text-xl font-medium text-gray-900 mb-2">No articles in this category</h3>
            <p class="text-gray-600 mb-6">
                There are currently no published articles in the {{ $category->name }} category.
            </p>
            <a href="{{ route('home') }}" 
               class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Home
            </a>
        </div>
    @endif

    <!-- Other Categories -->
    @php
        $otherCategories = \App\Models\Category::where('id', '!=', $category->id)
            ->withCount(['posts' => function ($query) {
                $query->where('status', 'published');
            }])
            ->orderBy('name')
            ->limit(6)
            ->get();
    @endphp

    @if($otherCategories->count() > 0)
        <section class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Other Categories</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($otherCategories as $otherCategory)
                    <a href="{{ route('category.show', $otherCategory->slug) }}" 
                       class="group p-4 border border-gray-200 rounded-lg hover:border-blue-300 hover:shadow-md transition duration-300">
                        <div class="text-center">
                            <h3 class="font-medium text-gray-900 group-hover:text-blue-600 mb-1">
                                {{ $otherCategory->name }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ $otherCategory->posts_count }} {{ Str::plural('post', $otherCategory->posts_count) }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
