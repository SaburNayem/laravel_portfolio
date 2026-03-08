<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Message;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'projects' => Project::query()->count(),
                'skills' => Skill::query()->count(),
                'testimonials' => Testimonial::query()->count(),
                'posts' => BlogPost::query()->count(),
                'messages' => Message::query()->count(),
                'unread_messages' => Message::query()->where('is_read', false)->count(),
            ],
            'recentMessages' => Message::query()->latest()->take(5)->get(),
        ]);
    }
}
