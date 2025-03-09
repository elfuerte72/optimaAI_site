<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Получаем опубликованные статьи, отсортированные по дате публикации
        $posts = Post::published()->latest()->paginate(9);
        
        return view('blog.index', compact('posts'));
    }

    /**
     * Display the specified post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\View\View
     */
    public function show(Post $post)
    {
        // Проверяем, что статья опубликована
        if (!$post->is_published || $post->published_at > now()) {
            abort(404);
        }
        
        // Получаем другие опубликованные статьи для блока "Другие статьи"
        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();
        
        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
