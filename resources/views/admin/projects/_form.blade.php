@php($editing = isset($project))
<form method="POST" action="{{ $editing ? route('admin.projects.update', $project) : route('admin.projects.store') }}" class="space-y-4">
    @csrf
    @if($editing) @method('PUT') @endif
    <input name="title" value="{{ old('title', $project->title ?? '') }}" placeholder="Title" class="w-full rounded border px-3 py-2" required>
    <input name="slug" value="{{ old('slug', $project->slug ?? '') }}" placeholder="Slug (optional)" class="w-full rounded border px-3 py-2">
    <input name="category" value="{{ old('category', $project->category ?? '') }}" placeholder="Category" class="w-full rounded border px-3 py-2" required>
    <input name="image" value="{{ old('image', $project->image ?? '') }}" placeholder="Image URL" class="w-full rounded border px-3 py-2">
    <textarea name="description" rows="4" placeholder="Description" class="w-full rounded border px-3 py-2" required>{{ old('description', $project->description ?? '') }}</textarea>
    <input name="technologies" value="{{ old('technologies', isset($project) ? implode(',', $project->technologies ?? []) : '') }}" placeholder="Laravel, Alpine.js, MySQL" class="w-full rounded border px-3 py-2">
    <input name="github_url" value="{{ old('github_url', $project->github_url ?? '') }}" placeholder="GitHub URL" class="w-full rounded border px-3 py-2">
    <input name="live_url" value="{{ old('live_url', $project->live_url ?? '') }}" placeholder="Live URL" class="w-full rounded border px-3 py-2">
    <div class="grid gap-4 md:grid-cols-2">
        <input type="number" min="0" name="display_order" value="{{ old('display_order', $project->display_order ?? 0) }}" class="w-full rounded border px-3 py-2">
        <label class="flex items-center gap-2"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}>Featured</label>
    </div>
    <button class="rounded bg-slate-900 px-4 py-2 text-white">{{ $editing ? 'Update' : 'Create' }} Project</button>
</form>
