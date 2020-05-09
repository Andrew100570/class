<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Entry;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

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
        return view('admin.manager',['entries'=>$entries,'user'=>$user,'message' => '']);
    }

    public function saveEntry(Request $request)
    {

        $rules = array(
            'description' => 'required'
        );

        $messages = array(
            'description.required' => 'Сделайте запись',
        );

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            $message = $validation->errors()->first();
            $user = Auth::user();
            $entries = $user->entries()->get();
            return view('admin.manager',['message' => $message,'entries'=>$entries,'user'=>$user]);
        } else {

                $description = strip_tags($request->all()['description']);
                $description = htmlspecialchars($description, ENT_QUOTES);

                $save = new Entry();

                $save->user_id = Auth::user()->id;
                $save->description = $description;

                $save->save();


        }

        return redirect('manager');
    }

    public function editEntry($id)
    {
        $entries = Entry::find($id);
        return view('admin.edit_manager',['entries'=>$entries]);
    }

    public function saveEditEntry(Request $request)
    {
        $description = strip_tags($request->all()['description']);
        $description = htmlspecialchars($description, ENT_QUOTES);

        $entry = Entry::find($request->all()['id']);

        $entry->description = $description;
        $entry->save();

        return redirect('manager');
    }


}
