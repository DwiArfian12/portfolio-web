<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Gallery;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::where('is_active', true)->first();
        $skills = Skill::where('is_active', true)->orderBy('order')->get();
        $galleries = Gallery::where('is_active', true)->orderBy('order')->get();
        $projects = Project::where('is_active', true)->orderBy('order')->get();

        return view('home', compact('profile', 'skills', 'galleries', 'projects'));
    }
}
