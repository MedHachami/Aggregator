<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function index(){


        return view('client.home');
    }

    public function getFavoritePosts(){
        return view('client.favoris');
    }


}
