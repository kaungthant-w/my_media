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

    //go to update page
    public function updatePostPage($id) {
        $updatePost = Post::where("post_id", $id)->first();
        $category = Category::get();
        $post = Post::get();
        return view("admin.post.update", compact(['updatePost', 'category','post']));
    }

    // update post
    public function updatePost($id, Request $request) {

        $validator = $this->checkPostValidation($request);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $this->requestUpdatePostData($request);

        if(isset($request->postImage)) {
            $this->storeNewUpdateImage($id, $request, $data);

        } else {
            Post::where('post_id', $id)->update($data);
        }

        return back();
    }

    private function storeNewUpdateImage($id, $request, $data) {
         //get from client
         $file = $request->file('postImage');
         $fileName = uniqid().'_'.$file -> getClientOriginalName();

         //put new image to data array
         $data['image'] = $fileName;

         //get image name from database
         $postData = Post::where('post_id', $id)->first();
         $dbImageName = $postData['image'];

         // delete image form public folder
         if(File::exists(public_path().'/postImage/'.$dbImageName)) {
             File::delete(public_path().'/postImage/'.$dbImageName);
         }

         //store new image under public folder
         $file->move(public_path().'/postImage', $fileName);

         //update new data with new image
         Post::where('post_id', $id)->update($data);
    }

    // request update post data
    private function requestUpdatePostData($request) {
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->postCategory,
            'updated_at' => Carbon::now()
        ];
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
