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
                    @php
                        $footerCategories = \App\Models\Category::withCount(['posts' => function ($query) {
                            $query->where('status', 'published');
                        }])->orderBy('name')->take(5)->get();
                    @endphp
                    @foreach($footerCategories as $category)
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
