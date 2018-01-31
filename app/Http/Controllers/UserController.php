<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;

class UserController extends Controller
{
    public function edit()
    {
        $user = User::find(auth()->user()->id);
        return view('admin.user.edit',compact('user'));
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $this->validate($request,[

            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:30|unique:users,id,'.auth()->user()->id,
            'password' => 'required|string|min:6|confirmed'
        ]);

        User::where('id',auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('home');
    }
}
