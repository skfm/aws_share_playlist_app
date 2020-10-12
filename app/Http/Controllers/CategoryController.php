<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request,string $title)
    {

        $category = Category::where('title', $title)->first();

        if(is_null($category)) {
            abort(404);
        }

        $sort = $request->input('sort');

        switch ($sort) {
            case "new":
                $playlists = $category->playlists()->orderBy('created_at', 'desc')->paginate(10);
                break;

            case "old":
                $playlists = $category->playlists()->orderBy('created_at', 'asc')->paginate(10);
                break;

            case "allStock":
                $playlists = $category->playlists()->withCount('stocks')->orderby('stocks_count', 'desc')->paginate(10);
                break;

            default:
                $playlists = $category->playlists()->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('categories.show', [
            'category' => $category,
            'playlists' => $playlists,
        ]);
        }
}
