@extends('layouts.admin')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Messages</h1>
<div class="overflow-hidden rounded-xl bg-white shadow">
<table class="w-full text-left text-sm"><thead class="bg-slate-50"><tr><th class="px-4 py-3">Name</th><th class="px-4 py-3">Email</th><th class="px-4 py-3">Subject</th><th class="px-4 py-3">Actions</th></tr></thead><tbody>
@foreach($messages as $message)
<tr class="border-t {{ $message->is_read ? '' : 'bg-amber-50' }}"><td class="px-4 py-3">{{ $message->name }}</td><td class="px-4 py-3">{{ $message->email }}</td><td class="px-4 py-3">{{ $message->subject }}</td><td class="px-4 py-3"><a class="text-cyan-600" href="{{ route('admin.messages.show', $message) }}">View</a> <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" class="inline">@csrf @method('DELETE') <button class="text-red-600">Delete</button></form></td></tr>
@endforeach
</tbody></table>
</div><div class="mt-4">{{ $messages->links() }}</div>
@endsection
