<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    private const FIELDS = [
        'hero_name',
        'hero_title',
        'hero_intro',
        'hero_profile_image',
        'resume_url',
        'contact_email',
        'contact_phone',
        'contact_location',
        'social_github',
        'social_linkedin',
        'social_twitter',
    ];

    public function edit(): View
    {
        $settings = SiteSetting::query()->pluck('value', 'key');

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'hero_name' => ['nullable', 'string', 'max:120'],
            'hero_title' => ['nullable', 'string', 'max:180'],
            'hero_intro' => ['nullable', 'string', 'max:1000'],
            'hero_profile_image' => ['nullable', 'url', 'max:255'],
            'resume_url' => ['nullable', 'url', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:120'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'contact_location' => ['nullable', 'string', 'max:120'],
            'social_github' => ['nullable', 'url', 'max:255'],
            'social_linkedin' => ['nullable', 'url', 'max:255'],
            'social_twitter' => ['nullable', 'url', 'max:255'],
        ]);

        foreach (self::FIELDS as $field) {
            SiteSetting::query()->updateOrCreate(['key' => $field], ['value' => $data[$field] ?? null]);
        }

        return back()->with('status', 'Settings updated.');
    }
}
