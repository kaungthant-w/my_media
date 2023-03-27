<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListController extends Controller
{
    //direct admin list page
    public function index() {
        return view('admin.list.index');
    }
}
