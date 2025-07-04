@extends('layouts.admin')

@section('title', 'Create Category')
@section('page-title', 'Create Category')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700">Dashboard</a>
    <span class="text-gray-500 mx-2">/</span>
    <a href="{{ route('admin.categories.index') }}" class="text-gray-500 hover:text-gray-700">Categories</a>
    <span class="text-gray-500 mx-2">/</span>
    <span class="text-gray-900">Create</span>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="card">
        <form action="{{ route('admin.categories.store') }}" method="POST" x-data="categoryForm()">
            @csrf

            <!-- Name -->
            <div class="mb-6">
                <label for="name" class="form-label">Category Name *</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
                       class="form-input @error('name') border-red-500 @enderror"
                       x-model="name"
                       @input="generateSlug()"
                       required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slug -->
            <div class="mb-6">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" 
                       id="slug" 
                       name="slug" 
                       value="{{ old('slug') }}"
                       class="form-input @error('slug') border-red-500 @enderror"
                       x-model="slug"
                       placeholder="Auto-generated from name">
                <p class="mt-1 text-sm text-gray-500">
                    URL-friendly version of the name. Leave empty to auto-generate.
                </p>
                @error('slug')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" 
                          name="description" 
                          rows="4"
                          class="form-input @error('description') border-red-500 @enderror"
                          placeholder="Brief description of this category">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-between">
                <a href="{{ route('admin.categories.index') }}" class="btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn-primary">
                    Create Category
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function categoryForm() {
    return {
        name: '{{ old('name') }}',
        slug: '{{ old('slug') }}',
        
        generateSlug() {
            if (!this.slug || this.slug === this.slugify(this.previousName)) {
                this.slug = this.slugify(this.name);
            }
            this.previousName = this.name;
        },
        
        slugify(text) {
            return text
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }
    }
}
</script>
@endsection
