<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //direct admin post page
    public function index() {
        return view('admin.post.index');
    }
}
