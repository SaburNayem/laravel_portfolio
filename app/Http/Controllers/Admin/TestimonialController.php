<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        return view('admin.testimonials.index', [
            'testimonials' => Testimonial::query()->latest()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Testimonial::query()->create($this->validated($request));

        return redirect()->route('admin.testimonials.index')->with('status', 'Testimonial created.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update($this->validated($request));

        return redirect()->route('admin.testimonials.index')->with('status', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();

        return back()->with('status', 'Testimonial deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'client_name' => ['required', 'string', 'max:120'],
            'client_role' => ['nullable', 'string', 'max:120'],
            'client_company' => ['nullable', 'string', 'max:120'],
            'feedback' => ['required', 'string', 'max:2000'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'avatar' => ['nullable', 'url', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $data['is_featured'] = $request->boolean('is_featured');

        return $data;
    }
}
