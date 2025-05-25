<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usermodel;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    $user = usermodel::all();
    return view('user.all', compact('user'));

}

public function register ()
{
    return view('user.register');
}

public function store(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'nohp' => 'required|string|min:8|confirmed|unique:users',
    ]);
    return redirect()->route('login')->with('success', 'User registered successfully!');
}


public function edit($id)
{
    $user = usermodel::find($id);
    return view('user.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,',
        'password' => 'nullable|string|min:8|confirmed',
        'nohp' => 'required|string|min:8|confirmed|unique:users'
    ]);

    $update = [
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? bcrypt($request->password) : null,
        'nohp' => 'required|string|min:8|confirmed|unique:users'
    ];
    
    return redirect()->route('user.all')->with('success', 'User updated successfully!');

    public function delete($id)
    {
        $user = usermodel::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('user.all')->with('success', 'User deleted successfully!');
        }
        return redirect()->route('user.all')->with('error', 'User not found!');
    }
}