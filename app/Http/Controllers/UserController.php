<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileInfosReq;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(User $user) {
        return view('user.profile', compact('user'));
    }

    public function edit(User $user) {


        // abort_if(auth()->user()->cannot('edit-update-profile', $user) , 403, 'You are not authorized to see this page.');
        // $this->authorize('edit-update-profile', $user);
        return view('user.edit', compact('user'));
    }

    public function update(User $user, UpdateProfileInfosReq $request) {

        $data = $request->safe()->collect();
        if ($request->password == '') {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        if ($data->has('image')) {
            $path = $request->file('image')->store('users', 'public');
            $data['image'] = '/' . $path;
        }

        $data['private_account'] = $request->has('private_account');

        $user->update($data->toArray());

        session()->flash('success', 'Your profile has been updated!');

        return redirect()->route('user_profile', $user->username);
    }

    public function follow(User $user) {
        auth()->user()->follow($user);
        return back();
    }

    public function unfollow(User $user) {
        auth()->user()->unfollow($user);
        return back();
    }
}