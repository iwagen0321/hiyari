<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class ProfileController extends Controller
{
    public function index()
    {
        $users = User::orderBy('employee_number','asc')->get();
        return view('profile.profile-index',compact('users'));
    }


    /**
     * Display the user's profile form.
     */
    public function edit(User $user): View
    {
        $title = 'アカウント編集';
        $type = 'update';
        $button = '更新';
        return view('profile.profile-form', compact('user','title','type','button'));
    }

  

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, User $user)
    {
        $inputs = $request->validate([
            'role' => ['required', 'boolean'],
            'family_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'employee_number' => ['required', 'integer', 'digits:4'],
            'division_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->role = $inputs['role'];
        $user->family_name = $inputs['family_name'];
        $user->first_name = $inputs['first_name'];
        $user->employee_number = $inputs['employee_number'];
        $user->division_name = $inputs['division_name'];
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('profile.edit',$user)->with('message','アカウントを修正しました');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('profile.index')->with('message','アカウントを削除しました');
    }


    public function show(User $user)
    {
        $title = 'アカウント削除';
        $type = 'destroy';
        $button = '削除';
        return view('profile.profile-form',compact('user','title','type','button'));
    }

}
