@extends('layouts.public')

@section('title', $post->title . ' - ' . config('app.name'))
@section('description', $post->excerpt)

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['title' => 'Home', 'url' => route('home')],
        ['title' => $post->category->name, 'url' => route('category.show', $post->category->slug)],
        ['title' => Str::limit($post->title, 50)]
    ]" />

    <!-- Article Header -->
    <header class="mb-8">
        <!-- Category -->
        <div class="mb-4">
            <a href="{{ route('category.show', $post->category->slug) }}" 
               class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 hover:bg-blue-200">
                {{ $post->category->name }}
            </a>
        </div>

        <!-- Title -->
        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">
            {{ $post->title }}
        </h1>

        <!-- Meta Information -->
        <div class="flex items-center text-gray-600 mb-6">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center mr-3">
                    <span class="text-white font-medium">
                        {{ substr($post->user->name, 0, 1) }}
                    </span>
                </div>
                <div>
                    <p class="font-medium text-gray-900">{{ $post->user->name }}</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <time datetime="{{ $post->created_at->toISOString() }}">
                            {{ $post->created_at->format('M d, Y \a\t g:i A') }}
                        </time>
                        @if($post->updated_at->gt($post->created_at))
                            <span class="mx-2">•</span>
                            <span>Updated {{ $post->updated_at->format('M d, Y') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Image -->
        @if($post->featured_image)
            <div class="mb-8">
                <img src="{{ Storage::url($post->featured_image) }}" 
                     alt="{{ $post->title }}"
                     class="w-full h-64 lg:h-96 object-cover rounded-lg shadow-lg">
            </div>
        @endif
    </header>

    <!-- Article Content -->
    <article class="bg-white rounded-lg shadow-md p-8 mb-12">
        <div class="prose prose-lg max-w-none">
            {!! $post->content !!}
        </div>
    </article>

    <!-- Related Posts -->
    @if($relatedPosts->count() > 0)
        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Articles</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ $relatedPosts->count() > 2 ? '3' : '2' }} gap-6">
                @foreach($relatedPosts as $relatedPost)
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <!-- Post Image -->
                        <div class="aspect-w-16 aspect-h-9">
                            @if($relatedPost->featured_image)
                                <img src="{{ Storage::url($relatedPost->featured_image) }}" 
                                     alt="{{ $relatedPost->title }}"
                                     class="w-full h-40 object-cover">
                            @else
                                <div class="w-full h-40 bg-gray-200 flex items-center justify-center">
                                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Post Content -->
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                <a href="{{ route('posts.show', $relatedPost->slug) }}" class="hover:text-blue-600">
                                    {{ $relatedPost->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-3">
                                {{ Str::limit($relatedPost->excerpt, 100) }}
                            </p>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>{{ $relatedPost->user->name }}</span>
                                <time datetime="{{ $relatedPost->created_at->toISOString() }}">
                                    {{ $relatedPost->created_at->format('M d, Y') }}
                                </time>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <!-- Navigation -->
    <div class="flex justify-between items-center bg-white rounded-lg shadow-md p-6">
        <a href="{{ route('category.show', $post->category->slug) }}" 
           class="inline-flex items-center text-blue-600 hover:text-blue-800">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to {{ $post->category->name }}
        </a>
        
        <a href="{{ route('home') }}" 
           class="inline-flex items-center text-gray-600 hover:text-gray-800">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Home
        </a>
    </div>
</div>
@endsection
