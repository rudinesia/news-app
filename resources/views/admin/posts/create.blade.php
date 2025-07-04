@extends('layouts.admin')

@section('title', 'Create Post')
@section('page-title', 'Create Post')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700">Dashboard</a>
    <span class="text-gray-500 mx-2">/</span>
    <a href="{{ route('admin.posts.index') }}" class="text-gray-500 hover:text-gray-700">Posts</a>
    <span class="text-gray-500 mx-2">/</span>
    <span class="text-gray-900">Create</span>
@endsection

@section('content')
<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" x-data="postForm()"
    @csrf
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Title & Slug -->
            <div class="card">
                <div class="space-y-4">
                    <!-- Title -->
                    <div>
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}"
                               class="form-input @error('title') border-red-500 @enderror"
                               x-model="title"
                               @input="generateSlug()"
                               required>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" 
                               id="slug" 
                               name="slug" 
                               value="{{ old('slug') }}"
                               class="form-input @error('slug') border-red-500 @enderror"
                               x-model="slug"
                               placeholder="Auto-generated from title">
                        <p class="mt-1 text-sm text-gray-500">
                            URL-friendly version of the title. Leave empty to auto-generate.
                        </p>
                        @error('slug')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="card">
                <div>
                    <label for="content" class="form-label">Content *</label>
                    <textarea id="content"
                              name="content"
                              class="form-input @error('content') border-red-500 @enderror"
                              rows="20">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Excerpt -->
            <div class="card">
                <div>
                    <label for="excerpt" class="form-label">Excerpt</label>
                    <textarea id="excerpt" 
                              name="excerpt" 
                              rows="3"
                              class="form-input @error('excerpt') border-red-500 @enderror"
                              placeholder="Brief summary of the post (optional)">{{ old('excerpt') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">
                        If left empty, an excerpt will be automatically generated from the content.
                    </p>
                    @error('excerpt')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Publish -->
            <div class="card">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Publish</h3>
                
                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="form-label">Status *</label>
                    <select id="status" 
                            name="status" 
                            class="form-input @error('status') border-red-500 @enderror"
                            required>
                        <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex space-x-3">
                    <a href="{{ route('admin.posts.index') }}" class="btn-secondary flex-1 text-center">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary flex-1">
                        Create Post
                    </button>
                </div>
            </div>

            <!-- Category -->
            <div class="card">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Category</h3>
                
                <div>
                    <label for="category_id" class="form-label">Category *</label>
                    <select id="category_id" 
                            name="category_id" 
                            class="form-input @error('category_id') border-red-500 @enderror"
                            required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                    {{ old('category_id', $selectedCategory) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Featured Image -->
            <div class="card">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Featured Image</h3>
                
                <div>
                    <label for="featured_image" class="form-label">Image</label>
                    <input type="file" 
                           id="featured_image" 
                           name="featured_image" 
                           class="form-input @error('featured_image') border-red-500 @enderror"
                           accept="image/*"
                           @change="previewImage($event)">
                    <p class="mt-1 text-sm text-gray-500">
                        Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB.
                    </p>
                    @error('featured_image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    
                    <!-- Image Preview -->
                    <div x-show="imagePreview" class="mt-4">
                        <img :src="imagePreview" class="w-full h-32 object-cover rounded-lg" alt="Preview">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function postForm() {
    return {
        title: '{{ old('title') }}',
        slug: '{{ old('slug') }}',
        previousTitle: '{{ old('title') }}',
        imagePreview: null,
        
        init() {
            // Initialize CKEditor
            this.$nextTick(() => {
                initCKEditor('content');
            });
        },
        
        generateSlug() {
            if (!this.slug || this.slug === this.slugify(this.previousTitle)) {
                this.slug = this.slugify(this.title);
            }
            this.previousTitle = this.title;
        },
        
        slugify(text) {
            return text
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        },
        
        previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                this.imagePreview = null;
            }
        }
    }
}
</script>
@endsection
