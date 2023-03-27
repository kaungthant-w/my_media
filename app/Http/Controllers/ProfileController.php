<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // direct admin home page
    public function index() {
        $id = Auth::user()->id;
        $user = User::select('id', 'name', 'email','address', 'phone', 'gender')->where('id', $id)->first();
        // dd($user->toArray());
        return view('admin.profile.index', compact('user'));
    }


    //update admin account
    public function updateAdminAccount(Request $request) {
        // dd($request->all());
        $userData = $this->getUserInfo($request);
        User::where('id', Auth::user()->id)->update($userData);
        return back();
    }

    //get user info
    private function getUserInfo($request) {
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'address' => $request->adminAddress,
            'phone' => $request->adminPhone,
            'gender' => $request->adminGender,
            'updated_at' => Carbon::now()
        ];
    }
}
