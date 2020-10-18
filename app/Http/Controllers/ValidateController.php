<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidateController {


    public function ValidateMake(){

        $error = '';
        return view('result',['error'=>$error]);

    }


    public function resultValidate(Request $request){
        $rules = ['email'=>'email', 'user_fields'=>'required','site_url'=>'url','multiselect'=>'unique'];
        $validator = new MyValidator($rules);
        $error = $validator->validate($request->all());

        return view('result',['error'=>$error]);
    }


}

