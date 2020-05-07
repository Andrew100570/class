<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdminController extends Controller
{

    public function index()
    {
//        User::where('name','!','Admin')->get();
//        dd();
        return view('admin.admin');
    }
}
