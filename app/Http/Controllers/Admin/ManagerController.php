<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $entries = $user->entries()->get();
        return view('admin.manager',['entries'=>$entries]);
    }
}
