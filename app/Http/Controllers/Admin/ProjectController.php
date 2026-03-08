<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        return view('admin.projects.index', [
            'projects' => Project::query()->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.projects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Project::query()->create($this->validated($request));

        return redirect()->route('admin.projects.index')->with('status', 'Project created.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $project->update($this->validated($request, $project->id));

        return redirect()->route('admin.projects.index')->with('status', 'Project updated.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return back()->with('status', 'Project deleted.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:180', 'unique:projects,slug'.($ignoreId ? ",{$ignoreId}" : '')],
            'category' => ['required', 'string', 'max:100'],
            'image' => ['nullable', 'url', 'max:255'],
            'description' => ['required', 'string', 'max:2500'],
            'technologies' => ['nullable', 'string', 'max:1000'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['technologies'] = isset($data['technologies']) && $data['technologies'] !== ''
            ? array_values(array_filter(array_map('trim', explode(',', $data['technologies']))))
            : [];
        $data['is_featured'] = $request->boolean('is_featured');
        $data['display_order'] = $data['display_order'] ?? 0;

        return $data;
    }
}
