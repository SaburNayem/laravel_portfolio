@extends('layouts.admin')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Portfolio Content Settings</h1>
<div class="rounded-xl bg-white p-6 shadow">
<form method="POST" action="{{ route('admin.settings.update') }}" class="grid gap-4 md:grid-cols-2">
    @csrf
    @method('PUT')
    <input name="hero_name" value="{{ old('hero_name', $settings['hero_name'] ?? '') }}" placeholder="Hero name" class="rounded border px-3 py-2">
    <input name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? '') }}" placeholder="Hero title" class="rounded border px-3 py-2">
    <textarea name="hero_intro" rows="3" placeholder="Hero intro" class="rounded border px-3 py-2 md:col-span-2">{{ old('hero_intro', $settings['hero_intro'] ?? '') }}</textarea>
    <input name="hero_profile_image" value="{{ old('hero_profile_image', $settings['hero_profile_image'] ?? '') }}" placeholder="Hero profile image URL" class="rounded border px-3 py-2 md:col-span-2">
    <input name="resume_url" value="{{ old('resume_url', $settings['resume_url'] ?? '') }}" placeholder="Resume URL" class="rounded border px-3 py-2">
    <input name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" placeholder="Contact email" class="rounded border px-3 py-2">
    <input name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" placeholder="Phone" class="rounded border px-3 py-2">
    <input name="contact_location" value="{{ old('contact_location', $settings['contact_location'] ?? '') }}" placeholder="Location" class="rounded border px-3 py-2">
    <input name="social_github" value="{{ old('social_github', $settings['social_github'] ?? '') }}" placeholder="GitHub URL" class="rounded border px-3 py-2">
    <input name="social_linkedin" value="{{ old('social_linkedin', $settings['social_linkedin'] ?? '') }}" placeholder="LinkedIn URL" class="rounded border px-3 py-2">
    <input name="social_twitter" value="{{ old('social_twitter', $settings['social_twitter'] ?? '') }}" placeholder="Twitter URL" class="rounded border px-3 py-2 md:col-span-2">
    <button class="rounded bg-slate-900 px-4 py-2 text-white md:col-span-2">Save Settings</button>
</form>
</div>
@endsection
