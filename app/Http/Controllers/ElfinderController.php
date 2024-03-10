<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ElfinderController extends Controller
{
    public function Index(Request $request){
        if(Auth::guard('admin')->check()){
            $id_elfinder='admin';
        }else{
            $id_elfinder = (session('id_elfinder')) ? session('id_elfinder') : 'admin';
        }
        
        return view('elfinder');//->with(['id_elfinder'=>$id_elfinder]);
    }

    public function User(Request $request){
        if(Auth::guard()->check()){
            $id_elfinder = (session('id_elfinder')) ? session('id_elfinder') : '';
            return view('elfinder-user')->with(['id_elfinder'=>$id_elfinder]);
        }else{
            return redirect()->route('error.show', ['403']);
        }
    }
}