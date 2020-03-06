<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UserRequest;
use App\Http\Controller\HomeController;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        if (Gate::allows('isAdmin')) {
            return User::whereType('adviser')->get();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //only admin can create users
        if(Gate::allows('isAdmin')){
            $validatedData = $request->validated();
            User::create([
                'user_name' => $request['user_name'],
                'email' => $request['email'],
                'type' => 'adviser',
                'password' => Hash::make($request['password']),
            ]);
        }
        return redirect('/home')->with('success', 'user added successfully');
    }
    

    public function show(User $user)
    {
        return view('admin.showUser',compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('auth.editProfile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        //if user is not admin he/she can update his/her account only
        $validatedData = $request->validated();
        auth()->user()->update([
            'user_name' => $request['user_name'],
            'email' => $request['email'],
        ]);
        if(!empty($request->password))
        {
            auth()->user()->update([
                'password' => Hash::make($request->password),
            ]);
        }
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //only admin can delete user
        if (Gate::allows('isAdmin')) {
            $user->delete();
            return redirect('/home'); 
        }
    }

    public function getDeactivated()
    {
        $users = User::onlyTrashed()->get();
        return view('admin.user.deactivated', compact('users'));
    }
}
