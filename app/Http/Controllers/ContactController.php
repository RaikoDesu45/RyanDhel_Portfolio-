<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $ownerEmail = (string) config('mail.contact_to', config('mail.from.address'));

        try {
            Mail::raw(
                "New portfolio message\n\n"
                . "Name: {$data['name']}\n"
                . "Email: {$data['email']}\n"
                . "Subject: {$data['subject']}\n\n"
                . "Message:\n{$data['message']}\n",
                function ($mail) use ($data, $ownerEmail): void {
                    $mail->to($ownerEmail)
                        ->replyTo($data['email'], $data['name'])
                        ->subject('Portfolio Contact: ' . $data['subject']);
                }
            );

            Mail::raw(
                "Hi {$data['name']},\n\n"
                . "Thank you for reaching out. I received your message and will respond via email as soon as possible.\n\n"
                . "Your message subject: {$data['subject']}\n\n"
                . "Regards,\nRyan Dhel S. Canja",
                function ($mail) use ($data): void {
                    $mail->to($data['email'], $data['name'])
                        ->subject('Thanks for your message');
                }
            );
        } catch (Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with('mail_error', 'Message could not be sent right now. Please try again in a few minutes.');
        }

        return back()->with('mail_success', 'Message sent. Please check your email for confirmation.');
    }
}
