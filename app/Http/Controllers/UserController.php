<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserController extends Controller
{

    public function index()
    {


        return view('client.home');
    }

    public function getFavoritePosts()
    {
        return view('client.favoris');
    }

    public function displayUsers()
    {
        $perPage = 3;

        $users = User::where('roles', '!=', 'admin')->paginate($perPage);

        return view('admin.dsplay_users', ['users' => $users]);
    }

    public function allUsers()
    {
        if (Auth::user()->roles != 'admin') {
            dd('You are not allowed');
        }

        $users = User::where('roles', '!=', 'admin')->get();

        return response()->json($users);
    }

    


}
