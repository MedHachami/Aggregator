<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function addSubscriber(Request $request){
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('subscriber', 'email'),
            ],
        ]);

        User::create([
            'email' => $request->input('email'),
            'subscriber',
            'password',
        ]);

        dd('sss');
        return back()->with('success', 'Vous avez été abonné avec succès.');

    }
}
