<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Gallery;
use App\Models\Project;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        $profileCount = Profile::count();
        $skillCount = Skill::count();
        $galleryCount = Gallery::count();
        $projectCount = Project::count();
        $messageCount = ContactMessage::count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        return view('admin.dashboard', compact(
            'profileCount', 'skillCount', 'galleryCount', 'projectCount', 'messageCount', 'unreadMessages'
        ));
    }
}
