<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'News App'))</title>
    <meta name="description" content="@yield('description', 'Latest news and articles')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-900">
                        {{ config('app.name') }}
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" 
                       class="text-gray-700 hover:text-blue-600 font-medium {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">
                        Home
                    </a>
                    
                    <!-- Categories Dropdown -->
                    <div class="relative" x-data="dropdown()">
                        <button @click="toggle()" 
                                class="flex items-center text-gray-700 hover:text-blue-600 font-medium">
                            Categories
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="open" 
                             @click.away="close()"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                             style="display: none;">
                            @php
                                $categories = \App\Models\Category::withCount(['posts' => function ($query) {
                                    $query->where('status', 'published');
                                }])->orderBy('name')->get();
                            @endphp
                            @foreach($categories as $category)
                                <a href="{{ route('category.show', $category->slug) }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ $category->name }}
                                    <span class="text-gray-500">({{ $category->posts_count }})</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </nav>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" 
                            class="text-gray-700 hover:text-blue-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <!-- Admin Link -->
                @auth
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                            Admin Panel
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-blue-600 text-sm">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <div class="hidden md:flex">
                        <a href="{{ route('login') }}" 
                           class="text-gray-700 hover:text-blue-600 text-sm font-medium">
                            Admin Login
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Mobile Navigation -->
            <div x-show="mobileMenuOpen"
                 x-data="{ mobileMenuOpen: false }"
                 class="md:hidden border-t border-gray-200 py-4"
                 style="display: none;">
                <div class="space-y-2">
                    <a href="{{ route('home') }}"
                       class="block text-gray-700 hover:text-blue-600 font-medium py-2">
                        Home
                    </a>

                    <div class="py-2">
                        <p class="text-gray-500 text-sm font-medium mb-2">Categories</p>
                        @php
                            $mobileCategories = \App\Models\Category::withCount(['posts' => function ($query) {
                                $query->where('status', 'published');
                            }])->orderBy('name')->get();
                        @endphp
                        @foreach($mobileCategories as $category)
                            <a href="{{ route('category.show', $category->slug) }}" 
                               class="block text-gray-600 hover:text-blue-600 py-1 pl-4">
                                {{ $category->name }} ({{ $category->posts_count }})
                            </a>
                        @endforeach
                    </div>
                    
                    @auth
                        <a href="{{ route('admin.dashboard') }}" 
                           class="block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                            Admin Panel
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="block text-gray-700 hover:text-blue-600 py-2">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" 
                           class="block text-gray-700 hover:text-blue-600 font-medium py-2">
                            Admin Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ config('app.name') }}</h3>
                    <p class="text-gray-300">
                        Your trusted source for the latest news and updates. 
                        Stay informed with our comprehensive coverage.
                    </p>
                </div>

                <!-- Categories -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Categories</h3>
                    <ul class="space-y-2">
                        @foreach($categories->take(5) as $category)
                            <li>
                                <a href="{{ route('category.show', $category->slug) }}" 
                                   class="text-gray-300 hover:text-white">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('home') }}" class="text-gray-300 hover:text-white">
                                Home
                            </a>
                        </li>
                        @auth
                            <li>
                                <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-white">
                                    Admin Panel
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="text-gray-300 hover:text-white">
                                    Admin Login
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-300">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
