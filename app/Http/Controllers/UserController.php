<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','DESC')->simplePaginate(10);
        return view('users', compact('users'));
    }

    public function edit($user)
    {
        return view('edit', compact('user'));
    }

    public function update(Request $request, $user)
    {
        $request->validate([
            'name' => 'required|min:5|max:255',
        ]);
        $user->update([
            'name' => $request->input('name')
        ]);

        return back()->withSuccess('User has been updated!');
    }

    public function destroy($user)
    {
        $user->delete();
        return back();
    }
}
