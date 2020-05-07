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
        $managers = User::where('role','0')->get();
        return view('admin.admin',['managers'=>$managers]);
    }

    public function tableById($id)
    {
        $user = User::find($id);
        $entries = $user->entries()->get();
        return view('admin.admin_manager',['entries'=>$entries,'user'=>$user]);
    }
}
