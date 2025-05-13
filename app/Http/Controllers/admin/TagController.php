<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(10);
        return view('backend.tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        return view('backend.tags.index');
    }
}
