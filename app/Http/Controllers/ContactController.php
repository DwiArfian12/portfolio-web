<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
            'captcha' => 'required|string',
        ]);

        // Verify captcha
        $expectedAnswer = session('captcha_answer');
        if (!$expectedAnswer || $request->captcha !== $expectedAnswer) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect captcha answer. Please try again.',
                'refresh_captcha' => true,
            ], 422);
        }

        // Clear captcha after successful verification
        session()->forget('captcha_answer');

        ContactMessage::create($request->except('captcha'));

        return response()->json(['success' => true, 'message' => 'Message sent successfully!']);
    }
}
