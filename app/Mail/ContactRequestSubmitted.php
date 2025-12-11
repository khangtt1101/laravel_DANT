<?php

namespace App\Mail;

use App\Models\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactRequestSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public ContactRequest $contactRequest;

    /**
     * Create a new message instance.
     */
    public function __construct(ContactRequest $contactRequest)
    {
        $this->contactRequest = $contactRequest;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this
            ->subject('Yêu cầu hỗ trợ mới từ ' . $this->contactRequest->full_name)
            ->view('emails.contact-request');
    }
}

