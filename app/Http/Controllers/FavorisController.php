<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\favoris;

class FavorisController extends Controller
{

    function makeFavoritePost($postId)
    {
        $user = Auth::user();

        $existingFavorite = favoris::where('user_id', $user->id)
            ->where('post_id', $postId)
            ->first();
        if ($existingFavorite) {

            $deleted = $existingFavorite->delete();
            return $deleted ? response()->json(['success' =>'not like'],200): response()->json(['error' =>'error'],300);
        }
        favoris::create([
            'user_id' => $user->id,
            'post_id' => $postId,
        ]);
        return response()->json(['success' =>'like'],200);
    }



}
