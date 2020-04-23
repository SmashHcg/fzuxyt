<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
         $this->validate($request, [
            'account' => 'required|unique:users|min:6|max:15',
            'email' => 'required|email|unique:users|max:255',
            'nickName' => 'required|max:10',
            'password' => 'required|confirmed|min:6'
        ]);
        return;
    }
}
