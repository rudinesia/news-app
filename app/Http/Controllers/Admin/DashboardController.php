<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Page;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        $user = auth()->user();
        
        // Get statistics based on user role
        if ($user->isSuperAdmin()) {
            $stats = [
                'total_posts' => Post::count(),
                'published_posts' => Post::published()->count(),
                'draft_posts' => Post::draft()->count(),
                'total_categories' => Category::count(),
                'total_users' => User::count(),
                'total_pages' => Page::count(),
            ];
            
            $recent_posts = Post::with(['user', 'category'])
                ->latest()
                ->limit(5)
                ->get();
        } else {
            // Kontributor only sees their own stats
            $stats = [
                'my_posts' => Post::where('user_id', $user->id)->count(),
                'my_published_posts' => Post::where('user_id', $user->id)->published()->count(),
                'my_draft_posts' => Post::where('user_id', $user->id)->draft()->count(),
                'total_categories' => Category::count(),
            ];
            
            $recent_posts = Post::with(['user', 'category'])
                ->where('user_id', $user->id)
                ->latest()
                ->limit(5)
                ->get();
        }

        return view('admin.dashboard', compact('stats', 'recent_posts'));
    }
}
