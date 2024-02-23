<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


class VerifyEmailController extends Controller
{

    public function notice()
    {

        return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {

        $request->fulfill();

        return view('pages.email-verified');
    }

    public function send(Request $request): \Illuminate\Http\RedirectResponse
    {

        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

}
