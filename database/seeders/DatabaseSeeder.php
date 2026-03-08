<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@portfolio.test'],
            ['name' => 'Portfolio Admin', 'password' => 'password', 'is_admin' => true],
        );

        $projectData = [
            ['SaaS Billing Platform', 'Web Development', 'Built a scalable multi-tenant billing portal.', ['Laravel', 'MySQL', 'Alpine.js']],
            ['Restaurant Delivery App', 'Mobile App Development', 'Flutter app with real-time order tracking.', ['Flutter', 'Firebase', 'Laravel API']],
            ['Startup Design System', 'UI/UX Design', 'Design tokens and reusable UI kit for product teams.', ['Figma', 'Tailwind CSS', 'Storybook']],
        ];

        foreach ($projectData as $index => [$title, $category, $description, $tech]) {
            Project::query()->updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'category' => $category,
                    'description' => $description,
                    'technologies' => $tech,
                    'image' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?q=80&w=1200&auto=format&fit=crop',
                    'github_url' => 'https://github.com',
                    'live_url' => 'https://example.com',
                    'is_featured' => $index === 0,
                    'display_order' => $index,
                ]
            );
        }

        foreach ([
            ['PHP', 'Programming Languages', 92],
            ['JavaScript', 'Programming Languages', 88],
            ['Python', 'Programming Languages', 80],
            ['Dart', 'Programming Languages', 76],
            ['Laravel', 'Frameworks', 94],
            ['Flutter', 'Frameworks', 83],
            ['React', 'Frameworks', 78],
            ['Git', 'Tools', 90],
            ['Docker', 'Tools', 76],
            ['Firebase', 'Tools', 72],
            ['Figma', 'Tools', 81],
        ] as $i => [$name, $category, $score]) {
            Skill::query()->updateOrCreate(['name' => $name], [
                'category' => $category,
                'proficiency' => $score,
                'display_order' => $i,
            ]);
        }

        foreach ([
            ['Web Development', 'Modern Laravel applications, dashboards, and APIs.'],
            ['Mobile App Development', 'Cross-platform mobile apps with robust backend integration.'],
            ['UI/UX Design', 'Interface systems focused on usability and conversion.'],
            ['API Development', 'High-performance API architecture and integrations.'],
        ] as $i => [$title, $desc]) {
            Service::query()->updateOrCreate(['title' => $title], ['description' => $desc, 'display_order' => $i]);
        }

        Experience::query()->updateOrCreate(['role' => 'Senior Laravel Developer', 'company' => 'Tech Studio'], [
            'employment_type' => 'Full-time',
            'start_date' => now()->subYears(2),
            'is_current' => true,
            'summary' => 'Leading backend architecture and frontend integration for SaaS products.',
        ]);

        Experience::query()->updateOrCreate(['role' => 'Freelance Full Stack Developer', 'company' => 'Independent'], [
            'employment_type' => 'Contract',
            'start_date' => now()->subYears(4),
            'end_date' => now()->subYears(2),
            'summary' => 'Delivered custom portals, e-commerce features, and API systems for clients.',
        ]);

        Education::query()->updateOrCreate(['institution' => 'State University', 'degree' => 'BSc'], [
            'field' => 'Computer Science',
            'start_date' => '2016-01-01',
            'end_date' => '2020-01-01',
            'achievements' => 'Graduated with distinction and led software project lab.',
        ]);

        Certificate::query()->updateOrCreate(['title' => 'Laravel Advanced Certification'], [
            'issuer' => 'Laravel Community',
            'issued_at' => '2024-06-10',
            'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1200&auto=format&fit=crop',
            'credential_url' => 'https://example.com/certificate',
        ]);

        foreach ([
            ['Nila Ahmed', 'Product Manager', 'Orbit Labs', 'Excellent communication and very clean architecture decisions.'],
            ['Rafi Karim', 'Founder', 'ScaleDesk', 'Delivered a premium dashboard and API layer ahead of schedule.'],
        ] as [$name, $role, $company, $feedback]) {
            Testimonial::query()->updateOrCreate(['client_name' => $name], [
                'client_role' => $role,
                'client_company' => $company,
                'feedback' => $feedback,
                'rating' => 5,
                'is_featured' => true,
            ]);
        }

        $category = BlogCategory::query()->updateOrCreate(['slug' => 'laravel'], ['name' => 'Laravel']);

        BlogPost::query()->updateOrCreate(['slug' => 'designing-clean-laravel-architecture'], [
            'blog_category_id' => $category->id,
            'user_id' => $admin->id,
            'title' => 'Designing Clean Laravel Architecture',
            'excerpt' => 'Practical patterns for organizing a maintainable Laravel codebase.',
            'content' => "A good Laravel architecture starts with clear boundaries.\n\nUse focused controllers, query scopes, and service classes where needed.",
            'cover_image' => 'https://images.unsplash.com/photo-1517180102446-f3ece451e9d8?q=80&w=1200&auto=format&fit=crop',
            'is_published' => true,
            'published_at' => now()->subDays(4),
        ]);

        foreach ([
            'hero_name' => 'Sabur Nayem',
            'hero_title' => 'Full Stack Developer | Mobile App Developer',
            'hero_intro' => 'I craft modern web platforms and mobile apps with elegant interfaces, robust APIs, and fast delivery cycles.',
            'hero_profile_image' => 'https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?q=80&w=800&auto=format&fit=crop',
            'resume_url' => 'https://example.com/resume.pdf',
            'contact_email' => 'hello@portfolio.test',
            'contact_phone' => '+880 1700-000000',
            'contact_location' => 'Dhaka, Bangladesh',
            'social_github' => 'https://github.com',
            'social_linkedin' => 'https://linkedin.com',
            'social_twitter' => 'https://x.com',
        ] as $key => $value) {
            SiteSetting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
