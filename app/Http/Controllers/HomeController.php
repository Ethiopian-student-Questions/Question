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
    protected $t = 7;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->ajustQuestionAnswerExplanation();
        if(Gate::allows('isAdmin')) {
            $users = UserController::index();
            return view('admin.adminHome', compact('users'));
        }
        elseif(Gate::allows('isAdvisor')) {
            $questions = $this->ajustQuestionAnswerExplanation();
            return view('question.index', compact('questions'));
        }
    }

    private function ajustQuestionAnswerExplanation()    
    {
        $questions = auth()->user()->questions;
        foreach ($questions as $question) {
            if($question->answer->count() > 0) {

                $answer = $question->answer;
                $correctAnswer = $answer->correct;
                $incorrectAnswerFromJson = json_decode($answer->incorrect, true);
                //select correct answer choise
                $choise = ['A', 'B', 'C', 'D'];
                $correctAnswerChoise = rand(0, 3);

                // give choice to all answers
                $incorrectAnswer = array();
                $count = 0;
                for ($i=0; $i < 4; $i++) { 
                    if($i != $correctAnswerChoise) {
                        $answer[$i] = $incorrectAnswerFromJson[$count++];
                    }
                    else {
                        $answer[$i] = $correctAnswer;
                    }
                }
            }
            $question['answer'] = $answer;
            return $question;
            }
    }
}
