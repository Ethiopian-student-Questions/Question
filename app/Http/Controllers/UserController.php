<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

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
            return User::all();
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
    public function store(Request $request)
    {
        //only admin can create users
        if(Gate::allows('isAdmin')){
            $this->validater($request, false);
            User::create([
                'user_name' => $request['user_name'],
                'email' => $request->email,
                'type' => 'adviser',
                'password' => Hash::make($request->password),
            ]);
        }
        return HomeController::index();
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    protected function validater($request, $isUpdate)
    {
        if ($isUpdate) {
            $request->validate([
                'user_name' => 'required|string|max:30|unique:users',
                'email' => 'required|string|email|unique:users|max:255',
            ]);

            if(!empty($request->password))
            {
                $request->validate([
                    'password' => 'required|string|min:6',
                ]);
            }
        } else {
            $request->validate([
                'user_name' => 'required|string|max:30|unique:users',
                'email' => 'required|string|email|unique:users|max:255',
                'password' => 'required|string|min:6',
            ]);
        }
        
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //if user is not admin he/she can update his/her account only
        $this->validater($request, true);
        auth()->user()->update([
            'user_name' => $request['user_name'],
        ]);
        if(!empty($request->password))
        {
            auth()->user()->update([
                'password' => Hash::make($request->password),
            ]);
        }
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
        }
    }
}
