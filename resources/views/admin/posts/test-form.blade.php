@extends('layouts.admin')

@section('title', 'Test Post Creation')
@section('page-title', 'Test Post Creation')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card">
        <h2 class="text-xl font-semibold mb-4">Simple Test Form (No JavaScript)</h2>
        
        <form action="{{ route('admin.posts.store.test') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label for="title" class="form-label">Title *</label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="Test Post {{ now()->format('Y-m-d H:i:s') }}"
                           class="form-input"
                           required>
                </div>

                <div>
                    <label for="content" class="form-label">Content *</label>
                    <textarea id="content"
                              name="content"
                              class="form-input"
                              rows="5"
                              required>This is a test post content created at {{ now()->format('Y-m-d H:i:s') }}</textarea>
                </div>

                <div>
                    <label for="status" class="form-label">Status *</label>
                    <select id="status" name="status" class="form-input" required>
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>

                <div>
                    <label for="category_id" class="form-label">Category *</label>
                    <select id="category_id" name="category_id" class="form-input" required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex space-x-3">
                    <a href="{{ route('admin.posts.index') }}" class="btn-secondary flex-1 text-center">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary flex-1">
                        Create Test Post
                    </button>
                </div>
            </div>
        </form>
        
        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <h3 class="font-semibold text-blue-800">Debug Info:</h3>
            <p class="text-sm text-blue-600">
                <strong>Route:</strong> {{ route('admin.posts.store.test') }}<br>
                <strong>CSRF Token:</strong> {{ csrf_token() }}<br>
                <strong>Current Time:</strong> {{ now()->format('Y-m-d H:i:s') }}
            </p>
        </div>
    </div>
</div>
@endsection
