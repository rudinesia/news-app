@props([
    'categories',
    'title' => 'Browse by Category',
    'columns' => 'lg:grid-cols-5',
    'showBackground' => true,
    'limit' => null
])

@php
    $displayCategories = $limit ? $categories->take($limit) : $categories;
@endphp

@if($displayCategories->count() > 0)
    <section class="{{ $showBackground ? 'bg-white rounded-lg shadow-md p-8' : '' }}">
        @if($title)
            <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ $title }}</h2>
        @endif
        
        <div class="grid grid-cols-2 md:grid-cols-3 {{ $columns }} gap-4">
            @foreach($displayCategories as $category)
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
