<?php

namespace App\Http\Controllers\Admin;

use App\Entry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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

    public function saveEntry(Request $request,$user_id)
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
            $success = 0;
        } else {
            try {
                $description = strip_tags($request->all()['description']);
                $description = htmlspecialchars($description, ENT_QUOTES);

                $save = new Entry();


                $save->user_id = $user_id;
                $save->description = $description;

                $save->save();

            } catch (\Exception $e) {
                $success = 0;
                $message = 'Произошла непредвиденная ошибка. Попробуйте позже или свяжитесь с администратором';
                Log::error($e->getMessage(), ['exception' => $e]);
            }
        }

        return redirect()->route('manager_by_id',['id'=>$user_id]);
    }


    public function editEntry($id)
    {

        $entries = Entry::find($id);
        return view('admin.edit_admin',['entries'=>$entries]);
    }


    public function saveEditEntry(Request $request)
    {
        $description = strip_tags($request->all()['description']);
        $description = htmlspecialchars($description, ENT_QUOTES);

        $entry = Entry::find($request->all()['id']);

        $entry->description = $description;
        $entry->save();

        return redirect()->route('manager_by_id',['id'=>$entry->user_id]);
    }

    public function deleteEntry($id)
    {
       $entry = Entry::find($id);
       $user_id = $entry->user_id;
       $entry->delete();

       return redirect()->route('manager_by_id',['id'=>$user_id]);
    }



}
