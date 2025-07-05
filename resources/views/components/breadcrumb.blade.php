@props([
    'items' => [],
    'class' => 'mb-8'
])

@if(count($items) > 0)
    <nav class="{{ $class }}">
        <ol class="flex items-center space-x-2 text-sm text-gray-500">
            @foreach($items as $index => $item)
                <li>
                    @if($index > 0)
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    @endif
                </li>
                <li>
                    @if(isset($item['url']) && !$loop->last)
                        <a href="{{ $item['url'] }}" class="hover:text-blue-600">
                            {{ $item['title'] }}
                        </a>
                    @else
                        <span class="{{ $loop->last ? 'text-gray-900' : '' }}">
                            {{ $item['title'] }}
                        </span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
