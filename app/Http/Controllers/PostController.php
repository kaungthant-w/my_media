<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //direct admin post page
    public function index() {
            $category = Category::get();
            $post = Post::get();
        return view('admin.post.index', compact(['category', 'post']));
    }

    //create post
    public function postCreate(Request $request) {
        $validator = $this->checkPostValidation($request);

        if($validator->fails()) {
            return back()->withErrors($validator) -> withInput();
        }

        // dd($request->postImage);
        if(!empty($request->postImage)) {
            $file = $request->file('postImage');
            $fileName = uniqid()."_".$file->getClientOriginalName();
            $file->move(public_path().'/postImage', $fileName);
            $data = $this->getPostData($request, $fileName);
        } else {
            $data = $this->getPostData($request, NULL);
        }
        Post::create($data);
        return back();
    }

    // delete post in database
    public function postDelete($id) {
        $postData = Post::where('post_id', $id) -> first();
        $dbImageName = $postData['image'];
        Post::where('post_id', $id) -> delete();

        if(File::exists(public_path().'/postImage/'. $dbImageName)) {
            File::delete(public_path().'/postImage/'. $dbImageName);
        }

        return back();
    }

    //update psot
    public function updatePostPage($id) {
        $updatePost = Post::where("post_id", $id)->first();
        $category = Category::get();
        $post = Post::get();
        return view("admin.post.update", compact(['updatePost', 'category','post']));
    }

    // get post data
    private function getPostData($request, $fileName) {
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'image' => $fileName,
            'category_id' => $request->postCategory,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
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
