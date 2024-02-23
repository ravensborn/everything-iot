<?php

namespace App\Http\Controllers;

use App\Mail\RequestReceived;
use App\Models\Category;
use App\Models\Post;
use App\Models\SupportRequestItem;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{

    public function support()
    {
        return view('pages.support');
    }

    public function supportEmail()
    {

        $validated = \request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:10000'
        ]);

        $item = new SupportRequestItem;
        $item->create($validated);

        $timeNetEmail = 'info@time-net.net';

        Mail::send(new RequestReceived($timeNetEmail, $validated['name'], $validated['email'], $validated['message']));

        $url = route('support') . '#support-form';

        return redirect()->to($url)->with([
            'success_message' => trans('website.globals.email_sent'),
        ]);
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function downloads()
    {
        return view('pages.downloads');
    }

    public function soon()
    {
        return view('pages.coming-soon');
    }

    public function about()
    {

        $teamMembers = TeamMember::where('is_visible', true)->orderBy('order', 'asc')->get();

        return view('pages.about', [
            'teamMembers' => $teamMembers
        ]);
    }

    public function banned()
    {

        return view('pages.banned');
    }

    public function privacyAndPolicy()
    {
        return view('pages.privacy-and-policy-' . app()->getLocale());
    }

    public function termsAndConditions()
    {
        return view('pages.terms-and-conditions-' . app()->getLocale());
    }
}
