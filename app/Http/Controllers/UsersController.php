<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
    //构造器方法指定登录检测过滤方法
    public function __construct()
    {
        //未登录状态可以访问这些页面
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store','index']
        ]);
        //已登录用户不允许访问登录页面
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    //创建用户
    public function create()
    {
        return view('users.create');
    }

    //查看某一用户
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    //查看所有用户
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    //注册用户,接受接受一个Illuminate\Http\Request实例参数来获得用户的所有输入数据
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

/*        session()->flash('success', '欢迎注册福大校友录~');

        return redirect()->route('users.show', [$user]);*/

        //注册后自动登录
        Auth::login($user);
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', [$user]);
    }

    //编辑个人信息
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    //更新个人信息
    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'nickName' => 'required|max:10',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $data = [];

        $data['nickName'] = $request->nickName;

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $user);
    }

    //管理员删除用户
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户!');
        return back();
    }
}
