@extends('layouts.admin')

@section('content')
<div class="mb-4 flex items-center justify-between"><h1 class="text-2xl font-bold">Projects</h1><a class="rounded bg-slate-900 px-4 py-2 text-sm text-white" href="{{ route('admin.projects.create') }}">Add Project</a></div>
<div class="overflow-hidden rounded-xl bg-white shadow">
<table class="w-full text-left text-sm"><thead class="bg-slate-50"><tr><th class="px-4 py-3">Title</th><th class="px-4 py-3">Category</th><th class="px-4 py-3">Actions</th></tr></thead><tbody>
@foreach($projects as $project)
<tr class="border-t"><td class="px-4 py-3">{{ $project->title }}</td><td class="px-4 py-3">{{ $project->category }}</td><td class="px-4 py-3"><a class="text-cyan-600" href="{{ route('admin.projects.edit', $project) }}">Edit</a> <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" class="inline">@csrf @method('DELETE') <button class="text-red-600">Delete</button></form></td></tr>
@endforeach
</tbody></table>
</div><div class="mt-4">{{ $projects->links() }}</div>
@endsection
