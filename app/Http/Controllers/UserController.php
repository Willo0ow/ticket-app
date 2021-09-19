<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        return DB::table('users')
        ->leftJoin('departments', 'users.department_id', 'departments.id')
        ->select('users.*', 'departments.name as department')
        ->get();
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
    public function departmentUsers($dept_id){
        return User::where('department_id',$dept_id)->select('id', 'name', 'role', 'department_id')->get();
    }
}
