<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application homepage.
     */
    public function index()
    {
        $posts = Post::with(['user', 'category'])
            ->published()
            ->latest()
            ->paginate(10);

        $categories = Category::withCount(['posts' => function ($query) {
            $query->where('status', 'published');
        }])->get();

        return view('home', compact('posts', 'categories'));
    }
}
