<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Gallery;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::where('is_active', true)->first();
        $skills = Skill::where('is_active', true)->orderBy('order')->get();
        $galleries = Gallery::where('is_active', true)->orderBy('order')->get();
        $projects = Project::where('is_active', true)->orderBy('order')->get();

        // Generate simple captcha
        $captcha = $this->generateCaptcha();
        session(['captcha_answer' => $captcha['answer']]);

        return view('home', compact('profile', 'skills', 'galleries', 'projects', 'captcha'));
    }

    /**
     * Generate a new captcha question and return it as JSON.
     */
    public function refreshCaptcha()
    {
        $captcha = $this->generateCaptcha();
        session(['captcha_answer' => $captcha['answer']]);

        return response()->json([
            'question' => $captcha['question'],
        ]);
    }

    /**
     * Generate a simple math captcha.
     */
    private function generateCaptcha()
    {
        $operators = ['+', '-', '*'];
        $operator = $operators[array_rand($operators)];

        switch ($operator) {
            case '+':
                $a = rand(1, 20);
                $b = rand(1, 20);
                $answer = $a + $b;
                break;
            case '-':
                $a = rand(10, 30);
                $b = rand(1, 10);
                $answer = $a - $b;
                break;
            case '*':
                $a = rand(2, 10);
                $b = rand(2, 9);
                $answer = $a * $b;
                break;
        }

        $question = "What is {$a} {$operator} {$b}?";

        return [
            'question' => $question,
            'answer' => (string) $answer,
        ];
    }
}
