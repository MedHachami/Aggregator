<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use App\Models\post;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Category;
use SimplePie\SimplePie;

class FluxRSSController extends Controller
{
    public function addRssPage()
    {
        $categories = Category::all();
        return view('admin.addSource', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required',
            'category' => 'required',
        ]);

        dd($request);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $feed = simplexml_load_file($request->url);

        foreach ($feed->channel->item as $item) {
            $category_id = (int)$request->category;
            // Get the image URL from media:thumbnail if present, otherwise use a default value
            $image = isset($item->children('media', true)->thumbnail['url'])
                ? (string)$item->children('media', true)->thumbnail['url']
                : $item->enclosure['url'];

            if (Category::where('id', $category_id)->exists()) {
                post::create([
                    'url' => $request->url,
                    'title' => $item->title,
                    'description' => $item->description,
                    'image' => $image,
                    'category_id' => $category_id,
                ]);
            } else {
                // Handle the case where the category does not exist
                return back()->with('error', 'this category doesn\'t exist');
            }
        }


        $categories = Category::all();
        return redirect()->route('rss.index', compact('categories'))->with('success', 'source added successfully!');
    }


    public function showRss(Request $request)
    {

        if(!isset($posts)) {
            $posts = post::query();
        }


        // Paginate the news items
        $perPage = 10;
        $currentPage = Paginator::resolveCurrentPage() ?: 1;
        $postsPaginated = $posts->paginate($perPage, ['*'], 'page', $currentPage);

        // Set the path for pagination
        $postsPaginated->setPath(route('rss.index', ['sort' => $request->sort, 'category' => $request->category]));

        $categories = Category::all();

        return view('admin.showSources', compact('postsPaginated', 'categories'));
    }

    public function category(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sort' => 'required|int',
            'category' => 'required|int',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $posts = post::query();
        if ($request->category) {
            $posts->where('category_id', (int)$request->category);

        }

        // Sorting
        switch ($request->sort) {
            case 1:
                // newest
                $posts->orderBy('created_at', 'desc');
                break;
            default:
                // oldest
                $posts->orderBy('created_at')   ;
        }


        return redirect()->route('rss.index', compact('posts'));

    }







}
