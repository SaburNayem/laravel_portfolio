<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $projects = Project::query()->orderByDesc('is_featured')->orderBy('display_order')->latest()->get();
        $skills = Skill::query()->orderBy('display_order')->get()->groupBy('category');
        $testimonials = Testimonial::query()->where('is_featured', true)->latest()->get();
        $experiences = Experience::query()->orderByDesc('start_date')->orderBy('display_order')->get();
        $services = Service::query()->orderBy('display_order')->get();
        $education = Education::query()->orderByDesc('start_date')->orderBy('display_order')->get();
        $certificates = Certificate::query()->orderByDesc('issued_at')->orderBy('display_order')->get();
        $blogPosts = BlogPost::query()->where('is_published', true)->latest('published_at')->take(3)->get();

        $hero = [
            'name' => SiteSetting::getValue('hero_name', 'Sabur Nayem'),
            'title' => SiteSetting::getValue('hero_title', 'Full Stack Laravel & Mobile Developer'),
            'intro' => SiteSetting::getValue('hero_intro', 'I build performant web and mobile products with elegant, business-focused user experiences.'),
            'email' => SiteSetting::getValue('contact_email', 'hello@example.com'),
            'phone' => SiteSetting::getValue('contact_phone', '+880 1000-000000'),
            'location' => SiteSetting::getValue('contact_location', 'Dhaka, Bangladesh'),
            'resume' => SiteSetting::getValue('resume_url', '#'),
            'github' => SiteSetting::getValue('social_github', '#'),
            'linkedin' => SiteSetting::getValue('social_linkedin', '#'),
            'twitter' => SiteSetting::getValue('social_twitter', '#'),
            'profile_image' => SiteSetting::getValue('hero_profile_image', 'https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?q=80&w=800&auto=format&fit=crop'),
        ];

        return view('pages.home', compact(
            'projects',
            'skills',
            'testimonials',
            'experiences',
            'services',
            'education',
            'certificates',
            'blogPosts',
            'hero',
        ));
    }
}
