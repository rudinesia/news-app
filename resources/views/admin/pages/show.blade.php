@extends('admin.layouts.app')

@section('title', 'View Page')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">{{ $page->title }}</h3>
                        <div>
                            <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Pages
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h1>{{ $page->title }}</h1>
                                <div class="text-muted mb-3">
                                    <small>
                                        <i class="fas fa-calendar"></i> Created: {{ $page->created_at->format('M d, Y H:i') }}
                                        @if($page->updated_at != $page->created_at)
                                            | <i class="fas fa-edit"></i> Updated: {{ $page->updated_at->format('M d, Y H:i') }}
                                        @endif
                                    </small>
                                </div>
                            </div>

                            <div class="content">
                                {!! $page->content !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Page Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>Status:</strong>
                                        @if($page->status == 'published')
                                            <span class="badge badge-success">Published</span>
                                        @else
                                            <span class="badge badge-warning">Draft</span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <strong>Slug:</strong>
                                        <br>
                                        <code>{{ $page->slug }}</code>
                                    </div>

                                    @if($page->status == 'published')
                                        <div class="mb-3">
                                            <strong>Public URL:</strong>
                                            <br>
                                            <a href="{{ url('/page/' . $page->slug) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-external-link-alt"></i> View Page
                                            </a>
                                        </div>
                                    @endif

                                    <div class="mb-3">
                                        <strong>Created:</strong>
                                        <br>
                                        {{ $page->created_at->format('M d, Y H:i') }}
                                    </div>

                                    <div class="mb-3">
                                        <strong>Last Updated:</strong>
                                        <br>
                                        {{ $page->updated_at->format('M d, Y H:i') }}
                                    </div>

                                    <hr>

                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit Page
                                        </a>
                                        
                                        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this page?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger w-100">
                                                <i class="fas fa-trash"></i> Delete Page
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.content {
    line-height: 1.6;
}

.content h1, .content h2, .content h3, .content h4, .content h5, .content h6 {
    margin-top: 1.5rem;
    margin-bottom: 1rem;
}

.content p {
    margin-bottom: 1rem;
}

.content ul, .content ol {
    margin-bottom: 1rem;
    padding-left: 2rem;
}

.content blockquote {
    border-left: 4px solid #007bff;
    padding-left: 1rem;
    margin: 1rem 0;
    font-style: italic;
    color: #6c757d;
}

.content table {
    width: 100%;
    margin-bottom: 1rem;
    border-collapse: collapse;
}

.content table th,
.content table td {
    padding: 0.75rem;
    border: 1px solid #dee2e6;
}

.content table th {
    background-color: #f8f9fa;
    font-weight: bold;
}
</style>
@endpush
