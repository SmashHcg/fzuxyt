<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //创建用户
    public function create()
    {
        return view('users.create');
    }

    //展示用户
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    //接受接受一个Illuminate\Http\Request实例参数来获得用户的所有输入数据
    public function store(Request $request)
    {
         $this->validate($request, [
            'account' => 'required|unique:users|min:6|max:15',
            'email' => 'required|email|unique:users|max:255',
            'nickName' => 'required|max:10',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'account' => $request->account,
            'email' => $request->email,
            'nickName' => $request->nickName,
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', '欢迎注册福大校友录~');

        return redirect()->route('users.show', [$user]);
    }
}
