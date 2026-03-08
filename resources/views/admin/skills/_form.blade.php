@php($editing = isset($skill))
<form method="POST" action="{{ $editing ? route('admin.skills.update', $skill) : route('admin.skills.store') }}" class="space-y-4">
    @csrf
    @if($editing) @method('PUT') @endif
    <input name="name" value="{{ old('name', $skill->name ?? '') }}" placeholder="Skill name" class="w-full rounded border px-3 py-2" required>
    <input name="category" value="{{ old('category', $skill->category ?? '') }}" placeholder="Category" class="w-full rounded border px-3 py-2" required>
    <input type="number" min="1" max="100" name="proficiency" value="{{ old('proficiency', $skill->proficiency ?? 80) }}" class="w-full rounded border px-3 py-2" required>
    <input type="number" min="0" name="display_order" value="{{ old('display_order', $skill->display_order ?? 0) }}" class="w-full rounded border px-3 py-2">
    <button class="rounded bg-slate-900 px-4 py-2 text-white">{{ $editing ? 'Update' : 'Create' }} Skill</button>
</form>
