<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(): View
    {
        return view('admin.skills.index', [
            'skills' => Skill::query()->orderBy('display_order')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.skills.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Skill::query()->create($this->validated($request));

        return redirect()->route('admin.skills.index')->with('status', 'Skill created.');
    }

    public function edit(Skill $skill): View
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $skill->update($this->validated($request));

        return redirect()->route('admin.skills.index')->with('status', 'Skill updated.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return back()->with('status', 'Skill deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'category' => ['required', 'string', 'max:120'],
            'proficiency' => ['required', 'integer', 'between:1,100'],
            'icon' => ['nullable', 'string', 'max:50'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['display_order'] = $data['display_order'] ?? 0;

        return $data;
    }
}
