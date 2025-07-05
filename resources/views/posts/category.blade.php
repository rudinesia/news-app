@extends('layouts.public')

@section('title', $category->name . ' - ' . config('app.name'))
@section('description', $category->description ?: 'Browse all articles in ' . $category->name . ' category')

@section('content')
<div class="space-y-8">
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['title' => 'Home', 'url' => route('home')],
        ['title' => $category->name]
    ]" class="" />

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
                <x-post-card :post="$post" :show-category="false" :excerpt-limit="150" />
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

    <x-category-grid
        :categories="$otherCategories"
        title="Other Categories"
        columns="lg:grid-cols-6"
    />
</div>
@endsection
