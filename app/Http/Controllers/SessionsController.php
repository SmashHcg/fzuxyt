<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    //用户登录返回视图调用create方法
    public function create()
    {
        return view('sessions.create');
    }


    //用户登录验证方法
    public function store(Request $request)
    {

        $credentials = $this->validate($request, [
            'account' => 'required|min:6|max:15',
            'password' => 'required|min:6'
        ]);

        /*$account = $request->account;
        $password = $request->password;*/

        if (Auth::attempt($credentials, $request->has('remember'))) {
        // 该用户存在于数据库，且账号和密码相符合
            session()->flash('success', '欢迎回来！');
            return redirect()->route('users.show', [Auth::user()]);
        } else {
            session()->flash('danger', '很抱歉，您的账号和密码不匹配');
            return redirect()->back()->withInput();
        }
    }

    //用户退出登录
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出');
        return redirect('login');
    }
}
