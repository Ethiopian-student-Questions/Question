<?php

namespace App\Http\Controllers;

use App\Answer;
// use App\Http\Controllers\ExplanationController;
use Illuminate\Http\Request;
use App\Question;
use App\Explanation;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\QuestionRequest;
use App\Subject;
use App\Grade;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return view('question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('auth');
        if(Gate::allows('isAdvisor')) {
            $subjects=Subject::select(['id','name'])->get();
            $grades=Grade::where('id','>=','6')->select('id')->get();
            return view('question.create',compact('grades','subjects'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
     
        $this->middleware('auth');
       // dd($request->validated());
        if(Gate::allows('isAdvisor')) {
                    $validatedData = $request->validated();
            $question = Question::create([
                'user_id'=>auth()->user()->id,
                'grade_id' => $validatedData['grade_id'],
                'subject_id' => $validatedData['subject_id'],
                'body' => $validatedData['body'],
                'is_approved'=>true,
            ]);
    
            // create this question explanation
            Explanation::create([
                'question_id'=>$question->id,
                'body'=>$validatedData['explanation']
            ]);
            // ExplanationController::store($question->id, $validatedData['explanation']);
            
            //select correct answer choise
            $choise = ['A', 'B', 'C', 'D'];
            $correctAnswerChoise = rand(0, 3);
            // conver incorrect answer to json file
            $incorrectAnswer = array();
            $count = 1;
            for ($i=0; $i < 4; $i++) { 
                if($i != $correctAnswerChoise) {
                    $incorrectAnswer[$choise[$i]] = $validatedData['incorrect_answer_'.$count++];
                }
                else {
                    $i++;
                    $incorrectAnswer[$choise[$i]] = $validatedData['incorrect_answer_'.$count++];
                }
            }
            $incorrectAnswer = json_encode($incorrectAnswer);
    
            //create answer for this question
            Answer::create([
                'question_id'=>$question->id,
                'correct'=>$validatedData['correct_answer'],
                'incorrect'=>$incorrectAnswer
            ]);
            // AnswerController::store($question->id, $validatedData['correct_answer'], $incorrectAnswer);
            $this->index();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('question.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $this->middleware('auth');
        if(Gate::allows('isAdvisor')) {
            return view('question.edit');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $this->middleware('auth');
        if(Gate::allows('isAdvisor')) {
            $validatedData = $request->validated();
            $question->update([
                'grade_id' => $validatedData['grade_id'],
                'subject_id' => $validatedData['subject_id'],
                'body' => $validatedData['body'],
            ]);
    
            // create this question explanation
            Explanation::update($question->id, $validatedData['explanation']);
            
            
            // conver incorrect answer to json file
            $incorrectAnswer = array();
            $incorrectAnswer[0] = $validatedData['incorrect_answer_1'];
            $incorrectAnswer[1] = $validatedData['incorrect_answer_2'];
            $incorrectAnswer[2] = $validatedData['incorrect_answer_3'];
            
            $incorrectAnswer = json_encode($incorrectAnswer);
    
            //create answer for this question
            Answer::update($question->id, $validatedData['correct_answer'], $incorrectAnswer);
            
            $this->index();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $this->middleware('auth');
        if(Gate::allows('isAdvisor')) {
            $question->delete();
            $this->index();
        }
    }
}
