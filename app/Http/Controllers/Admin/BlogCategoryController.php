<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.blog-categories.index', [
            'categories' => BlogCategory::query()->latest()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.blog-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        BlogCategory::query()->create($this->validated($request));

        return redirect()->route('admin.blog-categories.index')->with('status', 'Category created.');
    }

    public function edit(BlogCategory $blogCategory): View
    {
        return view('admin.blog-categories.edit', ['category' => $blogCategory]);
    }

    public function update(Request $request, BlogCategory $blogCategory): RedirectResponse
    {
        $blogCategory->update($this->validated($request, $blogCategory->id));

        return redirect()->route('admin.blog-categories.index')->with('status', 'Category updated.');
    }

    public function destroy(BlogCategory $blogCategory): RedirectResponse
    {
        $blogCategory->delete();

        return back()->with('status', 'Category deleted.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'slug' => ['nullable', 'string', 'max:120', 'unique:blog_categories,slug'.($ignoreId ? ",{$ignoreId}" : '')],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        return $data;
    }
}
