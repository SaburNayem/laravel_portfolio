@extends('layouts.admin')

@section('content')
<h1 class="mb-6 text-3xl font-bold">Dashboard</h1>
<div class="grid gap-4 md:grid-cols-3 lg:grid-cols-6">
    @foreach($stats as $label => $value)
        <div class="rounded-xl bg-white p-4 shadow">
            <p class="text-xs uppercase text-slate-500">{{ str_replace('_', ' ', $label) }}</p>
            <p class="text-2xl font-bold">{{ $value }}</p>
        </div>
    @endforeach
</div>

<h2 class="mb-3 mt-8 text-xl font-semibold">Recent Messages</h2>
<div class="overflow-hidden rounded-xl bg-white shadow">
    <table class="w-full text-left text-sm">
        <thead class="bg-slate-50"><tr><th class="px-4 py-3">Name</th><th class="px-4 py-3">Subject</th><th class="px-4 py-3">Date</th></tr></thead>
        <tbody>
            @forelse($recentMessages as $message)
                <tr class="border-t"><td class="px-4 py-3">{{ $message->name }}</td><td class="px-4 py-3">{{ $message->subject }}</td><td class="px-4 py-3">{{ $message->created_at->format('M d, Y') }}</td></tr>
            @empty
                <tr><td colspan="3" class="px-4 py-3">No messages yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
