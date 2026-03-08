<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-900">
<div class="min-h-screen md:flex">
    <aside class="w-full bg-slate-900 text-white md:w-64">
        <div class="p-4 text-lg font-semibold">Portfolio Admin</div>
        <nav class="space-y-1 px-3 pb-4 text-sm">
            <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.projects.index') }}">Projects</a>
            <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.skills.index') }}">Skills</a>
            <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.testimonials.index') }}">Testimonials</a>
            <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.blog-categories.index') }}">Blog Categories</a>
            <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.blog-posts.index') }}">Blog Posts</a>
            <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.messages.index') }}">Messages</a>
            <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('admin.settings.edit') }}">Portfolio Content</a>
            <a class="block rounded px-3 py-2 hover:bg-slate-800" href="{{ route('home') }}" target="_blank">View Site</a>
            <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="mt-2 w-full rounded bg-slate-700 px-3 py-2 text-left">Logout</button></form>
        </nav>
    </aside>
    <main class="flex-1 p-6">
        @if(session('status'))<div class="mb-4 rounded bg-emerald-600 px-4 py-2 text-sm text-white">{{ session('status') }}</div>@endif
        @if($errors->any())<div class="mb-4 rounded bg-red-600 px-4 py-2 text-sm text-white">{{ $errors->first() }}</div>@endif
        @yield('content')
    </main>
</div>
</body>
</html>
