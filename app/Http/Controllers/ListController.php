<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //direct admin list page
    public function index() {
        $userData = User::select('id', 'name', 'email', 'phone', 'address', 'gender')->get();
        // dd($userData->toArray());
        return view('admin.list.index', compact('userData'));
    }

    //delete admin account
    public function deleteAccount($id) {
        // dd($id);
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess'=>'User Account Deleted']);
    }

    //admin list search
    public function adminListSearch(Request $request) {
        $userData = User::orWhere('name', 'LIKE', '%'.$request->adminListSearchKey.'%')
        ->orWhere('email', 'LIKE', '%'. $request->adminListSearchKey.'%')
        ->orWhere('phone', 'LIKE', '%'. $request->adminListSearchKey.'%')
        ->orWhere('address', 'LIKE', '%'. $request->adminListSearchKey.'%')
        ->orWhere('gender', 'LIKE', '%'. $request->adminListSearchKey.'%')
        ->get();
        return view('admin.list.index',compact('userData'));
    }
}
