<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request){
        return redirect('dashboard');
    }

    public function index(){
        $users = User::all();
        return view('admin.user.index')
            ->with('users',$users);
    }
    public function create(){
        $permissions = Permission::all();
        return view('admin.user.add')
            ->with('permissions',$permissions);
    }
    public function store(Request $request){
        // dd($request->permissions);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role_id = 2;
        $user->save();
        $user->permissions()->attach($request->permissions);
        // $user->save();
        return back();
        //dd($request->all());
    }
}
