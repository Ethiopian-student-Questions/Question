<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function index()
    {
        if(Gate::allows('isAdmin')) {
            $users = UserController::index();
            return view('admin.adminHome', compact('users'));
        }
        elseif(Gate::allows('isAdvisor')) {
            $questions = auth()->user()->questions;
            return view('question.index', compact('questions'));
        }
    }
}
