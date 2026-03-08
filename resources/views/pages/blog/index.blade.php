@extends('layouts.app')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-16">
    <h1 class="mb-8 text-4xl font-bold">Blog</h1>
    <div class="grid gap-5 md:grid-cols-3">
        @forelse($posts as $post)
            <article class="rounded-xl bg-white p-5 shadow dark:bg-slate-900">
                <p class="text-xs text-slate-500">{{ optional($post->published_at)->format('M d, Y') }}</p>
                <h2 class="mt-2 text-xl font-semibold">{{ $post->title }}</h2>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $post->excerpt }}</p>
                <a class="mt-4 inline-block text-sm text-cyan-600" href="{{ route('blog.show', $post->slug) }}">Read article</a>
            </article>
        @empty
            <p>No posts found.</p>
        @endforelse
    </div>
    <div class="mt-8">{{ $posts->links() }}</div>
</section>
@endsection
