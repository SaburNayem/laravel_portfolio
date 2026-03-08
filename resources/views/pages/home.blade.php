@extends('layouts.app')

@section('content')
<div class="hero-bg relative overflow-hidden text-white">
    <div class="mx-auto grid min-h-[82vh] max-w-6xl items-center gap-8 px-4 py-16 md:grid-cols-2">
        <div>
            <p class="mb-3 text-sm uppercase tracking-[0.3em] text-cyan-300">Laravel PHP Developer</p>
            <h1 class="hero-title mb-4 text-4xl font-bold md:text-6xl">{{ $hero['name'] }}</h1>
            <h2 class="mb-4 text-xl text-cyan-100 md:text-2xl">{{ $hero['title'] }}</h2>
            <p class="max-w-xl text-slate-200">{{ $hero['intro'] }}</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="#projects" class="rounded bg-cyan-500 px-5 py-2 text-sm font-medium">View Projects</a>
                <a href="#contact" class="rounded border border-white/40 px-5 py-2 text-sm">Contact Me</a>
                <a href="{{ $hero['resume'] }}" class="rounded bg-white/20 px-5 py-2 text-sm">Download Resume</a>
            </div>
        </div>
        <div class="relative">
            <img src="{{ $hero['profile_image'] }}" alt="profile" class="mx-auto h-72 w-72 rounded-full border-4 border-cyan-300/40 object-cover shadow-2xl md:h-96 md:w-96"/>
        </div>
    </div>
</div>

<section id="about" class="mx-auto max-w-6xl px-4 py-20" data-aos="fade-up">
    <h2 class="mb-6 text-3xl font-bold">About Me</h2>
    <div class="grid gap-5 md:grid-cols-3">
        <div class="rounded-xl bg-white p-6 shadow dark:bg-slate-900"><h3 class="font-semibold">Story</h3><p class="mt-2 text-sm text-slate-600 dark:text-slate-300">I design and build full-stack products that scale, from architecture to polished UX.</p></div>
        <div class="rounded-xl bg-white p-6 shadow dark:bg-slate-900"><h3 class="font-semibold">Experience</h3><p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Shipping SaaS and business apps with Laravel, React, Flutter, and clean API contracts.</p></div>
        <div class="rounded-xl bg-white p-6 shadow dark:bg-slate-900"><h3 class="font-semibold">Goals</h3><p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Deliver products that are fast, accessible, and directly tied to business impact.</p></div>
    </div>
</section>

<section id="skills" class="bg-slate-200/60 py-20 dark:bg-slate-900/60">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="mb-8 text-3xl font-bold">Skills</h2>
        <div class="grid gap-6 md:grid-cols-3">
            @foreach($skills as $category => $items)
                <div class="rounded-xl bg-white p-6 shadow dark:bg-slate-900" data-aos="zoom-in">
                    <h3 class="mb-4 text-lg font-semibold">{{ $category }}</h3>
                    @foreach($items as $skill)
                        <div class="mb-3">
                            <div class="mb-1 flex justify-between text-sm"><span>{{ $skill->name }}</span><span>{{ $skill->proficiency }}%</span></div>
                            <div class="h-2 rounded bg-slate-200 dark:bg-slate-700"><div class="h-2 rounded bg-cyan-500" style="width: {{ $skill->proficiency }}%"></div></div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="projects" class="mx-auto max-w-6xl px-4 py-20" x-data="{ active: 'All' }">
    <h2 class="mb-6 text-3xl font-bold">Projects</h2>
    @php($categories = $projects->pluck('category')->unique()->values())
    <div class="mb-8 flex flex-wrap gap-2">
        <button @click="active='All'" :class="active==='All' ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'bg-white dark:bg-slate-900'" class="rounded px-4 py-2 text-sm">All</button>
        @foreach($categories as $category)
            <button @click="active='{{ $category }}'" :class="active==='{{ $category }}' ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'bg-white dark:bg-slate-900'" class="rounded px-4 py-2 text-sm">{{ $category }}</button>
        @endforeach
    </div>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach($projects as $project)
            <article x-show="active==='All' || active==='{{ $project->category }}'" class="tilt rounded-xl bg-white p-4 shadow transition-all dark:bg-slate-900" data-aos="fade-up">
                <img src="{{ $project->image ?: 'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1200&auto=format&fit=crop' }}" alt="{{ $project->title }}" class="mb-4 h-44 w-full rounded-lg object-cover"/>
                <h3 class="text-lg font-semibold">{{ $project->title }}</h3>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $project->description }}</p>
                <div class="mt-3 flex flex-wrap gap-1 text-xs">
                    @foreach(($project->technologies ?? []) as $tech)
                        <span class="rounded bg-cyan-100 px-2 py-1 text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-200">{{ $tech }}</span>
                    @endforeach
                </div>
                <div class="mt-4 flex gap-4 text-sm">
                    @if($project->github_url)<a class="text-cyan-600" href="{{ $project->github_url }}">GitHub</a>@endif
                    @if($project->live_url)<a class="text-emerald-600" href="{{ $project->live_url }}">Live Demo</a>@endif
                </div>
            </article>
        @endforeach
    </div>
</section>

<section id="experience" class="bg-slate-200/60 py-20 dark:bg-slate-900/60">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="mb-8 text-3xl font-bold">Experience Timeline</h2>
        <div class="space-y-4 border-l-2 border-cyan-500 pl-6">
            @foreach($experiences as $exp)
                <div class="rounded-xl bg-white p-5 shadow dark:bg-slate-900" data-aos="fade-right">
                    <h3 class="font-semibold">{{ $exp->role }} - {{ $exp->company }}</h3>
                    <p class="text-xs text-slate-500">{{ optional($exp->start_date)->format('M Y') }} - {{ $exp->is_current ? 'Present' : optional($exp->end_date)->format('M Y') }}</p>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $exp->summary }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="services" class="mx-auto max-w-6xl px-4 py-20">
    <h2 class="mb-8 text-3xl font-bold">Services</h2>
    <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-4">
        @foreach($services as $service)
            <article class="rounded-xl bg-white p-6 shadow transition hover:-translate-y-1 dark:bg-slate-900" data-aos="flip-left">
                <h3 class="font-semibold">{{ $service->title }}</h3>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $service->description }}</p>
            </article>
        @endforeach
    </div>
</section>

<section id="education" class="bg-slate-200/60 py-20 dark:bg-slate-900/60">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="mb-8 text-3xl font-bold">Education</h2>
        <div class="grid gap-4 md:grid-cols-2">
            @foreach($education as $item)
                <article class="rounded-xl bg-white p-6 shadow dark:bg-slate-900">
                    <h3 class="font-semibold">{{ $item->degree }} @if($item->field)in {{ $item->field }}@endif</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-300">{{ $item->institution }}</p>
                    <p class="text-xs text-slate-500">{{ optional($item->start_date)->format('Y') }} - {{ optional($item->end_date)->format('Y') }}</p>
                    <p class="mt-2 text-sm">{{ $item->achievements }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section id="certificates" class="mx-auto max-w-6xl px-4 py-20">
    <h2 class="mb-8 text-3xl font-bold">Certificates & Achievements</h2>
    <div class="grid gap-4 md:grid-cols-3">
        @foreach($certificates as $certificate)
            <article class="rounded-xl bg-white p-4 shadow dark:bg-slate-900" data-aos="zoom-in">
                <img src="{{ $certificate->image ?: 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?q=80&w=1200&auto=format&fit=crop' }}" class="mb-4 h-40 w-full rounded object-cover" alt="{{ $certificate->title }}">
                <h3 class="font-semibold">{{ $certificate->title }}</h3>
                <p class="text-sm text-slate-600 dark:text-slate-300">{{ $certificate->issuer }}</p>
            </article>
        @endforeach
    </div>
</section>

<section id="blog" class="bg-slate-200/60 py-20 dark:bg-slate-900/60">
    <div class="mx-auto max-w-6xl px-4">
        <div class="mb-8 flex items-center justify-between">
            <h2 class="text-3xl font-bold">Latest Blog Posts</h2>
            <a href="{{ route('blog.index') }}" class="text-cyan-600">View all</a>
        </div>
        <div class="grid gap-5 md:grid-cols-3">
            @foreach($blogPosts as $post)
                <article class="rounded-xl bg-white p-5 shadow dark:bg-slate-900">
                    <h3 class="font-semibold">{{ $post->title }}</h3>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $post->excerpt }}</p>
                    <a class="mt-4 inline-block text-sm text-cyan-600" href="{{ route('blog.show', $post->slug) }}">Read More</a>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section id="testimonials" class="mx-auto max-w-6xl px-4 py-20" x-data="{ index: 0 }">
    <h2 class="mb-8 text-3xl font-bold">Testimonials</h2>
    @if($testimonials->count())
        <div class="rounded-xl bg-white p-8 shadow dark:bg-slate-900">
            <p class="text-lg" x-text="@js($testimonials->pluck('feedback'))[index]"></p>
            <p class="mt-4 text-sm font-semibold" x-text="@js($testimonials->pluck('client_name'))[index]"></p>
            <div class="mt-4 flex gap-2">
                @foreach($testimonials as $i => $t)
                    <button @click="index = {{ $i }}" class="h-2 w-8 rounded" :class="index === {{ $i }} ? 'bg-cyan-500' : 'bg-slate-300 dark:bg-slate-700'"></button>
                @endforeach
            </div>
        </div>
    @endif
</section>

<section id="contact" class="bg-slate-950 py-20 text-white">
    <div class="mx-auto grid max-w-6xl gap-8 px-4 md:grid-cols-2">
        <div>
            <h2 class="mb-4 text-3xl font-bold">Contact</h2>
            <p>Email: {{ $hero['email'] }}</p>
            <p>Phone: {{ $hero['phone'] }}</p>
            <p>Location: {{ $hero['location'] }}</p>
            <div class="mt-4 flex gap-4 text-sm text-cyan-300">
                <a href="{{ $hero['github'] }}">GitHub</a>
                <a href="{{ $hero['linkedin'] }}">LinkedIn</a>
                <a href="{{ $hero['twitter'] }}">Twitter</a>
            </div>
        </div>
        <form action="{{ route('contact.store') }}" method="POST" class="glass rounded-xl p-6">
            @csrf
            <div class="grid gap-4">
                <input required name="name" placeholder="Name" class="rounded bg-white/10 px-3 py-2">
                <input required type="email" name="email" placeholder="Email" class="rounded bg-white/10 px-3 py-2">
                <input name="phone" placeholder="Phone" class="rounded bg-white/10 px-3 py-2">
                <input required name="subject" placeholder="Subject" class="rounded bg-white/10 px-3 py-2">
                <textarea required name="message" rows="4" placeholder="Message" class="rounded bg-white/10 px-3 py-2"></textarea>
                <button class="rounded bg-cyan-500 px-4 py-2">Send Message</button>
            </div>
        </form>
    </div>
</section>
@endsection
