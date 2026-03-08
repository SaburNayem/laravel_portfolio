@php($editing = isset($post))
<form method="POST" action="{{ $editing ? route('admin.blog-posts.update', $post) : route('admin.blog-posts.store') }}" class="space-y-4">
    @csrf
    @if($editing) @method('PUT') @endif
    <input name="title" value="{{ old('title', $post->title ?? '') }}" placeholder="Post title" class="w-full rounded border px-3 py-2" required>
    <input name="slug" value="{{ old('slug', $post->slug ?? '') }}" placeholder="Slug (optional)" class="w-full rounded border px-3 py-2">
    <select name="blog_category_id" class="w-full rounded border px-3 py-2"><option value="">No category</option>@foreach($categories as $category)<option value="{{ $category->id }}" {{ (string) old('blog_category_id', $post->blog_category_id ?? '') === (string) $category->id ? 'selected' : '' }}>{{ $category->name }}</option>@endforeach</select>
    <input name="cover_image" value="{{ old('cover_image', $post->cover_image ?? '') }}" placeholder="Cover image URL" class="w-full rounded border px-3 py-2">
    <textarea name="excerpt" rows="2" placeholder="Excerpt" class="w-full rounded border px-3 py-2">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
    <textarea name="content" rows="10" placeholder="Content" class="w-full rounded border px-3 py-2" required>{{ old('content', $post->content ?? '') }}</textarea>
    <label class="flex items-center gap-2"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published ?? true) ? 'checked' : '' }}>Published</label>
    <button class="rounded bg-slate-900 px-4 py-2 text-white">{{ $editing ? 'Update' : 'Create' }} Post</button>
</form>
