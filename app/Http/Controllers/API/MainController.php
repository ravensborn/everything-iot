<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\RequestReceived;
use App\Models\Category;
use App\Models\SupportRequestItem;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class MainController extends Controller
{

    public function submitSupportRequest() {

        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string|max:10000',
        ]);

        $item = new SupportRequestItem;
        $item->create($validated);

        $timeNetEmail = 'info@time-net.net';

        Mail::send(new RequestReceived($timeNetEmail, $validated['name'], $validated['email'], $validated['message']));

        return response()->json([
            'status' => true,
            'message' => 'Successfully submitted support request.',
            'data' => [],
        ]);
    }

}
