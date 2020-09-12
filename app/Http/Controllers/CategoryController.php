<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(string $title)
    {
        $category = Category::where('title', $title)->first();

        return view('categories.show', ['category' => $category]);
    }
}
