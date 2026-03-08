@extends('layouts.app')

@section('content')
<section class="mx-auto max-w-md px-4 py-16">
    <div class="rounded-xl bg-white p-6 shadow dark:bg-slate-900">
        <h1 class="mb-4 text-2xl font-semibold">Admin Login</h1>
        <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-4">
            @csrf
            <input required type="email" name="email" placeholder="Email" class="w-full rounded border border-slate-200 px-3 py-2 dark:border-slate-700 dark:bg-slate-800">
            <input required type="password" name="password" placeholder="Password" class="w-full rounded border border-slate-200 px-3 py-2 dark:border-slate-700 dark:bg-slate-800">
            <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="remember">Remember me</label>
            @error('email')<p class="text-sm text-red-500">{{ $message }}</p>@enderror
            <button class="w-full rounded bg-slate-900 px-4 py-2 text-white dark:bg-white dark:text-slate-900">Sign In</button>
        </form>
    </div>
</section>
@endsection
