@extends('layouts.app')

@section('content')
<article class="mx-auto max-w-4xl px-4 py-16">
    <a class="text-sm text-cyan-600" href="{{ route('blog.index') }}">Back to blog</a>
    <h1 class="mt-3 text-4xl font-bold">{{ $post->title }}</h1>
    <p class="mt-2 text-sm text-slate-500">{{ optional($post->published_at)->format('M d, Y') }} @if($post->category) · {{ $post->category->name }}@endif</p>
    @if($post->cover_image)
        <img src="{{ $post->cover_image }}" class="my-6 h-80 w-full rounded-xl object-cover" alt="{{ $post->title }}">
    @endif
    <div class="prose max-w-none dark:prose-invert">{!! nl2br(e($post->content)) !!}</div>
</article>

<section class="mx-auto mb-16 max-w-4xl px-4">
    <h2 class="mb-4 text-2xl font-semibold">Comments</h2>
    <form method="POST" action="{{ route('blog.comment', $post->slug) }}" class="mb-8 rounded-xl bg-white p-5 shadow dark:bg-slate-900">
        @csrf
        <div class="grid gap-4 md:grid-cols-2">
            <input required name="name" placeholder="Name" class="rounded border border-slate-200 px-3 py-2 dark:border-slate-700 dark:bg-slate-800">
            <input required type="email" name="email" placeholder="Email" class="rounded border border-slate-200 px-3 py-2 dark:border-slate-700 dark:bg-slate-800">
        </div>
        <textarea required name="comment" rows="4" class="mt-4 w-full rounded border border-slate-200 px-3 py-2 dark:border-slate-700 dark:bg-slate-800" placeholder="Your comment"></textarea>
        <button class="mt-4 rounded bg-cyan-500 px-4 py-2 text-white">Post Comment</button>
    </form>

    <div class="space-y-4">
        @forelse($post->comments as $comment)
            <article class="rounded-xl bg-white p-5 shadow dark:bg-slate-900">
                <p class="font-medium">{{ $comment->name }}</p>
                <p class="text-sm text-slate-500">{{ $comment->created_at->diffForHumans() }}</p>
                <p class="mt-2 text-sm">{{ $comment->comment }}</p>
            </article>
        @empty
            <p class="text-sm text-slate-500">No comments yet.</p>
        @endforelse
    </div>
</section>
@endsection
