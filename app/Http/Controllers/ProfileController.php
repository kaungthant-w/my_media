<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Validation\Validator;

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
        $validator = $this->userValidationCheck($request);

        if($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        User::where('id', Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess'=>'Admin account uptaded!']);
    }

    //direct change password page
    public function directChangePassword() {
        return view("admin.profile.changePassword");
    }

    //change password
    public function changePassword(Request $request) {
        // dd($request->all());
        $validator = $this->changePasswordValidationCheck($request);
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $dbData = User::where('id', Auth::user()->id)->first();
        $dbPassword = $dbData->password;
        $hashUserPassword = Hash::make($request->newPassword);
        // $old = Hash::make($request->oldPassword);

        $updateData = [
            'password' => $hashUserPassword,
            'updated_at' => Carbon::now()
        ];

        if(Hash::check($request->oldPassword, $dbPassword)) {
            User::where('id', Auth::user()->id)->update($updateData);
            return redirect()->route('dashboard');
        } else {
            return back()->with(['fail'=>'Old password do not match!']);
        }

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

    //user validation check
    private function userValidationCheck($request) {
        return Validator::make($request->all(), [
            'adminName' => 'required',
            'adminEmail' => 'required',
            'adminAddress' => 'required',
            'adminPhone' => 'required',
            'adminGender' => 'required'
        ], [
            'adminName.required' => 'Name is required!',
            'adminEmail.required' => 'Email is required',
            'adminAddress.required' => 'Address is required',
            'adminPhone.required' => 'Phone is required',
            'adminGender.required' => 'Gender is required'
        ]);
    }

    // password validation check
    private function changePasswordValidationCheck($request) {
        $validationRules = [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|max:15',
            'confirmPassword' => 'required|same:newPassword|max:15'
        ];
        $validationMessage = [
            'confrmPassword.same' => 'New Password & Confirm Password must be same'
        ];
        return Validator::make($request->all(),$validationRules, $validationMessage);
    }
}
