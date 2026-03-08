@php($editing = isset($category))
<form method="POST" action="{{ $editing ? route('admin.blog-categories.update', $category) : route('admin.blog-categories.store') }}" class="space-y-4">
    @csrf
    @if($editing) @method('PUT') @endif
    <input name="name" value="{{ old('name', $category->name ?? '') }}" placeholder="Category name" class="w-full rounded border px-3 py-2" required>
    <input name="slug" value="{{ old('slug', $category->slug ?? '') }}" placeholder="Slug (optional)" class="w-full rounded border px-3 py-2">
    <button class="rounded bg-slate-900 px-4 py-2 text-white">{{ $editing ? 'Update' : 'Create' }} Category</button>
</form>
