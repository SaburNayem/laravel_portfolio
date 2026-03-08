<!DOCTYPE html>
<html lang="en" x-data="{ dark: localStorage.getItem('theme') === 'dark' }" x-init="$watch('dark', value => { localStorage.setItem('theme', value ? 'dark' : 'light'); document.documentElement.classList.toggle('dark', value); }); document.documentElement.classList.toggle('dark', dark)">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modern Laravel PHP developer portfolio with projects, blog, and services.">
    <title>{{ $title ?? 'Portfolio' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { darkMode: 'class' }</script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: ui-sans-serif, system-ui, sans-serif; }
        .hero-bg {
            background: radial-gradient(circle at 20% 20%, rgba(59,130,246,.35), transparent 35%),
                        radial-gradient(circle at 80% 10%, rgba(16,185,129,.25), transparent 30%),
                        radial-gradient(circle at 50% 80%, rgba(245,158,11,.25), transparent 35%),
                        linear-gradient(135deg, #0f172a 0%, #111827 40%, #0b1220 100%);
        }
        .glass { background: rgba(255,255,255,.08); backdrop-filter: blur(12px); }
        .tilt:hover { transform: perspective(900px) rotateX(2deg) rotateY(-4deg) translateY(-8px); }
    </style>
</head>
<body class="bg-slate-100 text-slate-900 dark:bg-slate-950 dark:text-slate-100">
    <header class="fixed top-0 z-50 w-full border-b border-white/10 bg-slate-950/70 text-white backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3">
            <a href="{{ route('home') }}" class="font-semibold tracking-wide">Developer Portfolio</a>
            <nav class="hidden gap-5 text-sm md:flex">
                <a href="{{ route('home') }}#about">About</a>
                <a href="{{ route('home') }}#projects">Projects</a>
                <a href="{{ route('blog.index') }}">Blog</a>
                <a href="{{ route('home') }}#contact">Contact</a>
                <a href="{{ route('admin.dashboard') }}">Admin</a>
            </nav>
            <button @click="dark = !dark" class="rounded border border-white/30 px-3 py-1 text-xs">Theme</button>
        </div>
    </header>

    <main class="pt-16">
        @if (session('status'))
            <div class="mx-auto mt-4 max-w-6xl rounded bg-emerald-600 px-4 py-3 text-sm text-white">{{ session('status') }}</div>
        @endif

        @yield('content')
    </main>

    <script>
        AOS.init({ duration: 800, once: true });
        gsap.from('.hero-title', { y: 30, opacity: 0, duration: 1 });
    </script>
</body>
</html>
