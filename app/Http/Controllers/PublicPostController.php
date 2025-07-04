<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicPostController extends Controller
{
    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        // Only show published posts
        if ($post->status !== 'published') {
            abort(404);
        }

        // Get related posts from the same category
        $relatedPosts = $post->getRelatedPosts(4);

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    /**
     * Display posts by category.
     */
    public function category(Category $category, Request $request)
    {
        $posts = Post::with(['user', 'category'])
            ->where('category_id', $category->id)
            ->published()
            ->latest()
            ->paginate(12);

        return view('posts.category', compact('category', 'posts'));
    }
}
