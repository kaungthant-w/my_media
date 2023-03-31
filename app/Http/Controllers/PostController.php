<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //direct admin post page
    public function index() {
            $category = Category::get();
        return view('admin.post.index', compact('category'));
    }

    //create post
    public function postCreate(Request $request) {
        $validator = $this->checkPostValidation($request);

        if($validator->fails()) {
            return back()->withErrors($validator) -> withInput();
        }

        dd("this is OK");
    }

    // post validation check
    private function checkPostValidation($request) {
        return Validator::make($request->all(), [
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postCategory' => 'required',
        ]);
    }

}
