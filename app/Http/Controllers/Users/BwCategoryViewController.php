<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\CategoryBw;
use Illuminate\Http\Request;

class BwCategoryViewController extends Controller
{
    /**
     * Display a listing of all categories.
     */
    public function index()
    {
        $categories = CategoryBw::with('events')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('user.categories.index', compact('categories'));
    }

    /**
     * Display the specified category with its events.
     */
    public function show(string $id)
    {
        $category = CategoryBw::with('events')->findOrFail($id);

        return view('user.categories.show', compact('category'));
    }
}
