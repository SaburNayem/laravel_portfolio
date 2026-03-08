<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function index(): View
    {
        return view('admin.blog-posts.index', [
            'posts' => BlogPost::query()->with('category')->latest()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.blog-posts.create', [
            'categories' => BlogCategory::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        BlogPost::query()->create($this->validated($request));

        return redirect()->route('admin.blog-posts.index')->with('status', 'Post created.');
    }

    public function edit(BlogPost $blogPost): View
    {
        return view('admin.blog-posts.edit', [
            'post' => $blogPost,
            'categories' => BlogCategory::query()->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, BlogPost $blogPost): RedirectResponse
    {
        $blogPost->update($this->validated($request, $blogPost->id));

        return redirect()->route('admin.blog-posts.index')->with('status', 'Post updated.');
    }

    public function destroy(BlogPost $blogPost): RedirectResponse
    {
        $blogPost->delete();

        return back()->with('status', 'Post deleted.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $data = $request->validate([
            'blog_category_id' => ['nullable', 'exists:blog_categories,id'],
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:200', 'unique:blog_posts,slug'.($ignoreId ? ",{$ignoreId}" : '')],
            'excerpt' => ['nullable', 'string', 'max:300'],
            'content' => ['required', 'string'],
            'cover_image' => ['nullable', 'url', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;
        $data['user_id'] = $request->user()->id;

        return $data;
    }
}
