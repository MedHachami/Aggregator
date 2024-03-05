<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\post as postmodel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;


class Post extends Controller
{
    public function getPosts()
    {
        $user = Auth::user();

        $categoriesWithPosts = Category::with(['posts.favoris' => function ($query) use ($user) {
            if ($user) {
                $query->where('user_id', $user->id);
            }
        }])
            ->has('posts')
            ->get();



        $result = [];

        foreach ($categoriesWithPosts as $category) {
            $categoryTitle = $category->name;

            $postsData = $category->posts
                ->map(function ($post) use ($user) {
                    $favoriseStatus = 'not like';

                    // Check if the post has favoris relationship loaded
                    if ($post->relationLoaded('favoris')) {
                        // Check if favoris collection is not empty
                        if ($post->favoris->isNotEmpty()) {
                            $favoriseStatus = 'like';
                        }
                    } elseif ($user) {
                        // If favoris relationship is not loaded, check directly in the database
                        $favorisPostIds = $user->favoris->pluck('post_id')->toArray();

                        if (in_array($post->id, $favorisPostIds)) {
                            $favoriseStatus = 'like';
                        }
                    }

                    return [
                        'id' => $post->id,
                        'title' => $post->title,
                        'description' => $post->description,
                        'image' => $post->image,
                        'created_at' => $post->created_at,
                        'favorise' => $favoriseStatus,
                    ];
                });

            $result[] = [
                'categoryTitle' => $categoryTitle,
                'posts' => $postsData->toArray(),
            ];
        }

        return $result;
    }

    public function  GetPostsById($id){
        $post = postmodel::where('id', $id)->first();
        return view('client.detail-page',compact('post'));
    }

    public function displayTrendingNews(){
        $user = Auth::user();

        $trendingPosts = \App\Models\post::withCount('favoris')
            ->orderByDesc('favoris_count')
            ->limit(6)
            ->get();

        $trendingData = $trendingPosts->map(function ($post) use ($user) {
            $favoriseStatus = 'not like';

            if ($post->relationLoaded('favoris')) {
                if ($post->favoris->isNotEmpty()) {
                    $favoriseStatus = 'like';
                }
            } elseif ($user) {

                $favoris = Favori::where('user_id', $user->id)
                    ->where('post_id', $post->id)
                    ->first();

                if ($favoris) {
                    $favoriseStatus = 'like';
                }
            }

            return [
                'id' => $post->id,
                'title' => $post->title,
                'description' => $post->description,
                'image' => $post->image,
                'created_at' => $post->created_at,
            ];
        });

        return $trendingData;


    }

    public function favoritesPost(){
        $user = Auth::user();

        if ($user) {
            // Retrieve favorited posts with their details
            $favoritedPosts = $user->favoris()->with('post')->get();

            // Initialize an array to store favorited posts' details
            $favoritedPostDetails = [];

            foreach ($favoritedPosts as $favori) {
                $post = $favori->post;

                // Access post details
                $postDetails = [
                    'title' => $post->title,
                    'description' => $post->description,
                    'slug' => $post->slug,
                    'image' => $post->image,
                ];

                $favoritedPostDetails[] = $postDetails;
            }

            return response()->json($favoritedPostDetails);
        } else {
            // Handle the case where the user is not found
        }

    }


}
