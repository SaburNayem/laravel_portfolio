<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->string('category')->toString();

        $posts = BlogPost::query()
            ->with('category')
            ->where('is_published', true)
            ->when($category, fn ($query) => $query->whereHas('category', fn ($cat) => $cat->where('slug', $category)))
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('pages.blog.index', compact('posts', 'category'));
    }

    public function show(string $slug): View
    {
        $post = BlogPost::query()
            ->with(['category', 'comments' => fn ($query) => $query->where('is_approved', true)->latest()])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('pages.blog.show', compact('post'));
    }

    public function comment(Request $request, string $slug): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:120'],
            'comment' => ['required', 'string', 'max:2000'],
        ]);

        $post = BlogPost::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();
        $post->comments()->create($validated + ['is_approved' => true]);

        return back()->with('status', 'Comment added successfully.');
    }
}
