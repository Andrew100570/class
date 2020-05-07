<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class ManagerController extends Controller
{

    public function __construct()
    {
        $this->middleware('AdminProperties',['only'=>'tableById']);
        $this->middleware('ManagerProperties',['only'=>'index']);
    }

    public function index()
    {
        $user = Auth::user();
        $entries = $user->entries()->get();
        return view('admin.manager',['entries'=>$entries,'user'=>$user]);
    }

    public function tableById($id)
    {
        $user = User::find($id);
        $entries = $user->entries()->get();
        return view('admin.admin_manager',['entries'=>$entries,'user'=>$user]);
    }
}
