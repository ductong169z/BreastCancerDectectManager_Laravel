<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile');
    }


    /**
     * Update modify user information
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:32|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:32|required_with:new_password|same:new_password'
        ]);


        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->input('name');

        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = $request->input('new_password');
            } else {
                return redirect()->back()->withInput();
            }
        }

        $user->save();

        return redirect()->route('profile')->withSuccess('Profile updated successfully.');
    }

    /**
     * Display user reset password page
     * 
     */
    public function resetPassword(Request $request){
        $user = User::findOrFail(Auth::user()->id);


        return view('users.user_reset_password', [
            'user' => $user
        ]);

    }


    /**
     * Update user new password
     * 
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(User $user,Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        // // dd($user->password);
        // $pass = Hash::check($request->input('current_password'), $user->password);
        // dd($pass);
        // dd($request->get('password'));

        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => 'required|min:8|confirmed'
        ], ['password.confirmed' => 'New password and confirm password must match.']);

        $user->password = $request->input('password');
        $user->update();


        return redirect()->route('profile')
            ->withSuccess(__('Reset password successfully.'));
    }

}
