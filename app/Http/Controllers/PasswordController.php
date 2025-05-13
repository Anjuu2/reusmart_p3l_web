<?php

namespace App\Http\Controllers;

use App\Mail\LinkMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function sendLink(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'email' => 'required|email',
            'link'  => 'required|url',
        ]);

        // Kirim email
        Mail::to($data['email'])
            ->send(new LinkMail($data['link']));

        return back()->with('success', 'Link berhasil dikirim ke ' . $data['email']);
    }

    public function showForm()
    {
        return view('emails.kirimLinkForm');
    }
}
