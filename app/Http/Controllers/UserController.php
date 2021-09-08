<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return User::all();
    }
    public function update(Request $request, $user){
        return User::where('id',$user)->update($request->all());
    }
    public function show($user){
        return User::where('id',$user)->select('id', 'name', 'role', 'department_id')->first();
    }
    public function showAuthUser(){
        $user = Auth::user()->id;
        return User::where('id',$user)->select('id', 'name', 'role', 'department_id')->first();
    }
}
