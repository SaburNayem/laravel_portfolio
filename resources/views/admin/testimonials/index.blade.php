@extends('layouts.admin')
@section('content')
<div class="mb-4 flex items-center justify-between"><h1 class="text-2xl font-bold">Testimonials</h1><a class="rounded bg-slate-900 px-4 py-2 text-sm text-white" href="{{ route('admin.testimonials.create') }}">Add Testimonial</a></div>
<div class="overflow-hidden rounded-xl bg-white shadow"><table class="w-full text-left text-sm"><thead class="bg-slate-50"><tr><th class="px-4 py-3">Client</th><th class="px-4 py-3">Rating</th><th class="px-4 py-3">Actions</th></tr></thead><tbody>
@foreach($testimonials as $testimonial)
<tr class="border-t"><td class="px-4 py-3">{{ $testimonial->client_name }}</td><td class="px-4 py-3">{{ $testimonial->rating }}/5</td><td class="px-4 py-3"><a class="text-cyan-600" href="{{ route('admin.testimonials.edit', $testimonial) }}">Edit</a> <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" class="inline">@csrf @method('DELETE') <button class="text-red-600">Delete</button></form></td></tr>
@endforeach
</tbody></table></div><div class="mt-4">{{ $testimonials->links() }}</div>
@endsection
