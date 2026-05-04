<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // Create Profile
        Profile::create([
            'name' => 'Dwi Arfian',
            'title' => "Hello, I'm Dwi Arfian",
            'subtitle' => '"A college student majoring in Informatics Engineering Education <br>at <a href=\"https://www.uny.ac.id/\" style=\"color: #fff\">Yogyakarta State University.</a>"',
            'about_text' => 'I am a college student majoring in informatics engineering education at Yogyakarta State University. Have created several systems for companies, schools, university, and competitions. Having good leadership, time management and communication skills. Having fullstack website development skills.',
            'skills_headline' => 'Here are some skills I have.',
            'cv_file' => null,
            'instagram' => 'https://www.instagram.com/arfian.12/',
            'facebook' => 'https://www.facebook.com/dwi.arfian.79/',
            'twitter' => null,
            'youtube' => null,
            'github' => 'https://github.com/DwiArfian12',
            'is_active' => true,
        ]);

        // Create Skills
        $skills = [
            [
                'title' => 'Web Development',
                'description' => 'I am experienced in web development using Laravel, CodeIgniter, PHP native, HTML, CSS, Bootstrap, Tailwind, and JavaScript.',
                'icon_class' => 'flaticon-development',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Web Design',
                'description' => 'I also have experience in web design using Figma, and have several mockups that I have made.',
                'icon_class' => 'flaticon-idea',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'UI & Graphic Design',
                'description' => 'For UI/UX design I have designed several mobile apps, etc. As for graphic design, I can operate Canva, Photoshop, and Filmora.',
                'icon_class' => 'flaticon-seo',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Video Editing',
                'description' => 'I can edit video using Capcut, Premier Pro, Filmora and some editing tools, because I also have experience as a content creator.',
                'icon_class' => 'flaticon-development',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Office Work',
                'description' => 'I am quite experienced in operating office applications such as Microsoft Office, Google Workspace, and other office applications.',
                'icon_class' => 'flaticon-idea',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Etc.',
                'description' => 'I have many other skills and interests in IT, such as network engineering, IoT, data science, and others. I am always open to new things.',
                'icon_class' => 'flaticon-seo',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
