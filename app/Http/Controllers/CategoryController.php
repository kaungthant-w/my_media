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
        return back()->with(['deleteSuccess'=> 'Category Deleted!']);
    }

    //category search
    public function categorySearch(Request $request) {
        // dd($request->all());
        $category = Category::where('title', 'LIKE', '%'.$request->categorySearch.'%')->get();
        return view('admin.category.index', compact('category'));
    }

    // category validation check
    private function categoryValidationCheck($request) {
        $validationRules = [
            'categoryName' => 'required',
            'categoryDescription' => 'required',
        ];

        return Validator::make($request->all(), $validationRules);
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
