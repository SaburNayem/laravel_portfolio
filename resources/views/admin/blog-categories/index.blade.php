@extends('layouts.admin')
@section('content')
<div class="mb-4 flex items-center justify-between"><h1 class="text-2xl font-bold">Blog Categories</h1><a class="rounded bg-slate-900 px-4 py-2 text-sm text-white" href="{{ route('admin.blog-categories.create') }}">Add Category</a></div>
<div class="overflow-hidden rounded-xl bg-white shadow"><table class="w-full text-left text-sm"><thead class="bg-slate-50"><tr><th class="px-4 py-3">Name</th><th class="px-4 py-3">Slug</th><th class="px-4 py-3">Actions</th></tr></thead><tbody>
@foreach($categories as $category)
<tr class="border-t"><td class="px-4 py-3">{{ $category->name }}</td><td class="px-4 py-3">{{ $category->slug }}</td><td class="px-4 py-3"><a class="text-cyan-600" href="{{ route('admin.blog-categories.edit', $category) }}">Edit</a> <form method="POST" action="{{ route('admin.blog-categories.destroy', $category) }}" class="inline">@csrf @method('DELETE') <button class="text-red-600">Delete</button></form></td></tr>
@endforeach
</tbody></table></div><div class="mt-4">{{ $categories->links() }}</div>
@endsection
