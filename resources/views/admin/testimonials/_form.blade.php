@php($editing = isset($testimonial))
<form method="POST" action="{{ $editing ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" class="space-y-4">
    @csrf
    @if($editing) @method('PUT') @endif
    <input name="client_name" value="{{ old('client_name', $testimonial->client_name ?? '') }}" placeholder="Client name" class="w-full rounded border px-3 py-2" required>
    <input name="client_role" value="{{ old('client_role', $testimonial->client_role ?? '') }}" placeholder="Client role" class="w-full rounded border px-3 py-2">
    <input name="client_company" value="{{ old('client_company', $testimonial->client_company ?? '') }}" placeholder="Company" class="w-full rounded border px-3 py-2">
    <textarea name="feedback" rows="4" class="w-full rounded border px-3 py-2" required>{{ old('feedback', $testimonial->feedback ?? '') }}</textarea>
    <input type="number" min="1" max="5" name="rating" value="{{ old('rating', $testimonial->rating ?? 5) }}" class="w-full rounded border px-3 py-2">
    <input name="avatar" value="{{ old('avatar', $testimonial->avatar ?? '') }}" placeholder="Avatar URL" class="w-full rounded border px-3 py-2">
    <label class="flex items-center gap-2"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $testimonial->is_featured ?? true) ? 'checked' : '' }}>Featured</label>
    <button class="rounded bg-slate-900 px-4 py-2 text-white">{{ $editing ? 'Update' : 'Create' }} Testimonial</button>
</form>
