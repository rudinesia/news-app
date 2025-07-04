<!-- Header -->
<header class="bg-white shadow-sm border-b border-gray-200 mb-6">
    <div class="flex justify-between items-center py-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
            @hasSection('breadcrumb')
                <nav class="text-sm text-gray-500 mt-1">
                    @yield('breadcrumb')
                </nav>
            @endif
        </div>
        
        <div class="flex items-center space-x-4">
            <a href="{{ route('home') }}" target="_blank" class="btn-secondary">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                View Site
            </a>
        </div>
    </div>
</header>
