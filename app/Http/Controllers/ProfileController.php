<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    public function updateAdminAccount() {
        dd("updating..");
    }
}
