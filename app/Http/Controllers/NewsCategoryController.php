<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsCategory;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::all();

        $breadcrumbs = [
            ['title' => 'Головна', 'url' => route('home')],
            ['title' => 'Категорії новин', 'url' => route('news.categories')],
        ];

        return view('news.categories', compact('categories', 'breadcrumbs'));
    }
}

