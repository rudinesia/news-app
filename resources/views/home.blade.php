@extends('layouts.public')

@section('title', config('app.name') . ' - Latest News')
@section('description', 'Stay updated with the latest news and articles from ' . config('app.name'))

@section('content')
<div class="space-y-12">
    <!-- Hero Section -->
    @if($posts->count() > 0)
        @php $featuredPost = $posts->first(); @endphp
        <x-featured-post :post="$featuredPost" />
    @endif

    <!-- Latest Posts -->
    <section>
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Latest News</h2>
        </div>

        @if($posts->count() > 1)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts->skip(1) as $post)
                    <x-post-card :post="$post" />
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
    <x-category-grid :categories="$categories" />
</div>
@endsection
