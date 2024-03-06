<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\favoris;
use Illuminate\Http\Request;
use App\Models\post as postmodel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;



class Post extends Controller
{
    public function getPostByidNotAuth($id)
    {
        $post = postmodel::findOrFail($id);

        return response()->json($post);
    }


    public function getPostByid($id)
    {
        $post = PostModel::findOrFail($id);

        // Check if the user is authenticated
        if ($user = Auth::user()) {


            // Check if the user has liked the post
            $isLiked = $user->favoris->contains('post_id', $post->id);

            // Add the 'isLiked' attribute to the post
            $post->isLiked = $isLiked;
        }

        return response()->json($post);
    }
    public function getPostsNotAuth()
    {
        $cacheKey = 'posts_by_category';

        if (Cache::has($cacheKey)) {
            $postsByCategory = Cache::get($cacheKey);
        } else {
            $categories = Category::with('posts')->get();
            $postsByCategory = [];

            foreach ($categories as $category) {
                $posts = $category->posts
                    ->sortByDesc('created_at')
                    ->take(3);

                $postsByCategory[$category->id] = [
                    'category_title' => $category->name,
                    'posts' => $posts,
                ];
            }

            Cache::put($cacheKey, $postsByCategory, now()->addMinutes(30));
        }

        return response()->json($postsByCategory);
    }


    public function getPosts()
    {
        $user = Auth::user();

        $categories = Category::with('posts')->get();
        $postsByCategory = [];


        foreach ($categories as $category) {
            $posts = $category->posts
                ->sortByDesc('created_at')
                ->take(3)
                ->map(function ($post) use ($user) {
                    $post->favoris_status = $user->favoris->contains('post_id', $post->id);
                    return $post;
                });

            $postsByCategory[$category->id] = [
                'category_title' => $category->name,
                'posts' => $posts,
            ];
        }

        return response()->json($postsByCategory);


    }

    public function GetPostsById($id)
    {
        $post = postmodel::findOrFail($id);

        // Check if the user is logged in
        $user = Auth::user();

        // Include information about whether the authenticated user has liked the post
        $post->favoris_status = $user ? $user->favoris->contains('post_id', $post->id) : false;

        // $post = postmodel::where('id', $id)->first();
        return view('client.detail-page', compact('post'));
    }

    public function displayTrendingNews()
    {
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

    public function favoritesPost()
    {
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

    public function addComment(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'post_id' => 'required|integer',
            'content' => 'required|string',
        ]);


        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->content = $request->content;
        $comment->created_by = $user->id;

        $comment->save();

        return response()->json(['message' => 'Comment added successfully'], 200);

    }

    public function getCommentsByPost($postId)
    {
        $comments = Comment::where('post_id', $postId)->with('user')->get();

        return response()->json(['comments' => $comments], 200);
    }

}
