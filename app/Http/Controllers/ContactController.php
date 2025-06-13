<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
        return Inertia::render('Contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
            'type' => 'nullable|in:question,suggestion,complaint',
        ]);

        Contact::create($request->all());

        return back()->with('success', 'تم إرسال رسالتك بنجاح. سنرد عليك في أقرب وقت ممكن.');
    }
}
