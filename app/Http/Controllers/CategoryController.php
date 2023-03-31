<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct admin category page
    public function index() {
        $category = Category::get();
        return view('admin.category.index', compact('category'));
    }

    // create category
    public function createCategory(Request $request) {
        $validator = $this->categoryValidationCheck($request);
        if($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = $this->getCategoryData($request);
        Category::create($data);
        return back();
    }

    //delete category
    public function deleteCategory($id) {
        Category::where('category_id', $id) -> delete();
        // return back()->with(['deleteSuccess'=> 'Category Deleted!']);
        return redirect()->route("admin#category")->with(['deleteSuccess'=> 'Category Deleted!']);
    }

    //category search
    public function categorySearch(Request $request) {
        // dd($request->all());
        $category = Category::where('title', 'LIKE', '%'.$request->categorySearch.'%')->get();
        return view('admin.category.index', compact('category'));
    }


    //category edit
    public function categoryEdit($id) {
        $UpdateData = Category::where('category_id', $id)->first();
        $category = Category::get();
        return view("admin.category.edit",compact(["category", "UpdateData"]));
    }

    //category update
    public function categoryUpdate($id, Request $request) {

        $validator = $this->categoryValidationCheck($request);
        if($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $UpdateData = $this->getUpdateData($request);
        Category::where('category_id', $id)->update($UpdateData);
        return redirect()->route("admin#category");

    }

    // category validation check
    private function categoryValidationCheck($request) {
        $validationRules = [
            'categoryName' => 'required',
            'categoryDescription' => 'required',
        ];

        return Validator::make($request->all(), $validationRules);
    }

    //get update data
    private function getUpdateData($request) {
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
            'updated_at' => Carbon::now(),
        ];
    }

    //get category data
    private function getCategoryData($request) {
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
