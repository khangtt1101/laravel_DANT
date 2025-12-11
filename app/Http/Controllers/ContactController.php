<?php

namespace App\Http\Controllers;

use App\Mail\ContactRequestSubmitted;
use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Handle contact form submission and forward to support email.
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:1500'],
        ]);

        $contactRequest = ContactRequest::create($validated);

        $receiver = config('mail.contact_receiver') ?? env('CONTACT_RECEIVER_EMAIL', 'care@polytech.vn');

        Mail::to($receiver)->send(new ContactRequestSubmitted($contactRequest));

        return back()->with('success', 'Đã gửi yêu cầu. Bộ phận CSKH sẽ liên hệ với bạn trong thời gian sớm nhất.');
    }
}

