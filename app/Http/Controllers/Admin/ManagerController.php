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
        return view('admin.manager',['entries'=>$entries,'user'=>$user]);
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
            $success = 0;
        } else {
            try {
                $description = strip_tags($request->all()['description']);
                $description = htmlspecialchars($description, ENT_QUOTES);

                $save = new Entry();


                $save->user_id = Auth::user()->id;
                $save->description = $description;

                $save->save();

            } catch (\Exception $e) {
                $success = 0;
                $message = 'Произошла непредвиденная ошибка. Попробуйте позже или свяжитесь с администратором';
                Log::error($e->getMessage(), ['exception' => $e]);
            }
        }

        return redirect('manager');
    }


}
