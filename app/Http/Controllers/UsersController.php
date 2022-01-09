<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'),[
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
        $user->syncRoles($request->get('role'));
        $user->create(array_merge($request->validated(), [
            'password' => 'test',
            'role' => $request->role,
        ])); 

        
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
        if ($user->status==1) {
            $user->status=0;
        } else {
            $user->status=1;
        }
        $user->save();
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
