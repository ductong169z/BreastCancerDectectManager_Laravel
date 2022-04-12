<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\NotiController;

class UsersController extends Controller
{
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user=$request->user;
        $users = User::latest();
        if($users){
            $users = $users->where('users.name', 'LIKE', '%' . $user . '%');
        }
        $users = $users->paginate(10);
        return view('users.index', compact('users','user'),[
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Show form for creating user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create',['roles' => Role::latest()->get()]);
    }

    /**
     * Store a newly created user
     *
     * @param User $user
     * @param StoreUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request)
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
       
        $user->create(array_merge($request->validated(), [
            'password' => 'test',
            'role' => $request->role,
        ])); 

        $user->syncRoles($request->role);
        return redirect()->route('users.index')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Show user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }
    public function adminResetpassword(User $user)
    {
        return view('users.admin_reset_password', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    public function passwordReset(User $user, UpdateUserRequest $request)
    {
        //  //Validate form
        //  $validator = \Validator::make($request->all(),[
        //     'oldpassword'=>[
        //         'required', function($attribute, $value, $fail){
        //             if( !\Hash::check($value, Auth::user()->password) ){
        //                 return $fail(__('The current password is incorrect'));
        //             }
        //         },
        //         'min:8',
        //         'max:30'
        //      ],
        //      'newpassword'=>'required|min:8|max:30',
        //      'cnewpassword'=>'required|same:newpassword'
        //  ],[
        //      'oldpassword.required'=>'Enter your current password',
        //      'oldpassword.min'=>'Old password must have atleast 8 characters',
        //      'oldpassword.max'=>'Old password must not be greater than 30 characters',
        //      'newpassword.required'=>'Enter new password',
        //      'newpassword.min'=>'New password must have atleast 8 characters',
        //      'newpassword.max'=>'New password must not be greater than 30 characters',
        //      'cnewpassword.required'=>'ReEnter your new password',
        //      'cnewpassword.same'=>'New password and Confirm new password must match'
        //  ]);

        // if( !$validator->passes() ){
        //     return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        // }else{
             
        //  $update = User::find(Auth::user()->id)->update(['password'=>\Hash::make($request->newpassword)]);

        //  if( !$update ){
        //      return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to update password in db']);
        //  }else{
        //      return response()->json(['status'=>1,'msg'=>'Your password has been changed successfully']);
        //  }
        // }
        return redirect()->route('users.index')
            ->withSuccess(__('User updated successfully.'));
    }

    /**
     * Update user data
     *
     * @param User $user
     * @param UpdateUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $user->status = $request->status;
        $user->update($request->validated());

        $user->syncRoles($request->get('role'));

        return redirect()->route('users.index')
            ->withSuccess(__('User updated successfully.'));
    }

    /**
     * Update user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function savechange(User $user)
    {
        $user->save();

        return redirect()->route('users.index')
            ->withSuccess(__('User updated successfully.'));
    }

    /**
     * Delete user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $noti = new NotiController();
        if ($user->status==1) {
            $user->status=0;
            $msg = array
            (
              'body'  => "Đã deactive $user->name ",
              'title' => "Thông Báo hệ thống",
              'receiver' => 'erw',
              'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
              'sound' => 'mySound'/*Default sound*/
            );
        } else {
            $user->status=1;
            $msg = array
            (
              'body'  => "Da active $user->name",
              'title' => "Thông Báo hệ thống",
              'receiver' => 'erw',
              'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
              'sound' => 'mySound'/*Default sound*/
            );
        }
        $user->save();
       
        $noti->sennoti($msg);
        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }



    // public function search(Request request)
    // {
    //     $search = $require->get('search');
    //     $users = Users::where('name','LIKE','%'.$search.'%')->get();
    //     return view('users.index', compact('users'));
    // }

}
