<?php

namespace App\Http\Controllers;


use App\Answer;
use App\Http\Controllers\ExplanationController;
use App\Http\Controllers\AnswerController;
use Illuminate\Http\Request;
use App\Question;
use App\Explanation;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\QuestionRequest;
use App\Subject;
use App\Http\Controllers\HomeController;

use App\Grade;
use Illuminate\Support\Facades\DB;

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
            $grades = Grade::where('id', '>=', '6')->get();
            $subjects = Subject::all();
            return view('question.create', compact('grades', 'subjects'));

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
        // dd($request->validated()['correct_answer']);
        $this->middleware('auth');
       // dd($request->validated());
        if(Gate::allows('isAdvisor')) {
            $validatedData = $request->validated();

            DB::beginTransaction();
            try {
                $question = Question::create([
                    'grade_id' => $validatedData['grade_id'],
                    'subject_id' => $validatedData['subject_id'],
                    'body' => $validatedData['body'],
                    'user_id' => auth()->user()->id,
                    'is_approved' => true,
                ]);

                // create this question explanation
                ExplanationController::store($question->id, $validatedData['explanation']);
                
                
                // conver incorrect answer to json file
                $incorrectAnswer = array();
                $incorrectAnswer[0] = $validatedData['incorrect_answer_1'];
                $incorrectAnswer[1] = $validatedData['incorrect_answer_2'];
                $incorrectAnswer[2] = $validatedData['incorrect_answer_3'];
                $incorrectAnswer = json_encode($incorrectAnswer);
        
                //create answer for this question
                AnswerController::store($question->id, $validatedData['correct_answer'], $incorrectAnswer);
                DB::commit();
                return redirect('/home');
            }
            catch(\Exception $e) {
                DB::rollback();
                return redirect()->back();
            }
        }

    }

    /**
<<<<<<< HEAD
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)

    {   
            
    }


    /**
=======
>>>>>>> 1f1150240b51a4bad64bcb4f73d5bd604b97d71f
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $subjects=Subject::select(['id','name'])->where('id','!=',$question->subject_id)->get();
            $grades=Grade::where('id','>=','6')->where('id','!=',$question->grade_id)->select('id')->get();
            $current_subject=Subject::select(['id','name'])->where('id',$question->subject_id)->first();
            $current_grade=Grade::where('id',$question->grade_id)->select('id')->first();
            $incorrect=json_decode($question->answer->incorrect);
            // dd($incorrect[0]);
             return view('question.edit',compact('question','subjects','grades','current_subject','current_grade','incorrect'));
    }

    private static function adjustQuestionAnswerExplanation($question)    
    {

                $answer = $question->answer;
                $question['correct_answer'] = $answer->correct;
                $incorrectAnswers = json_decode($answer->incorrect, true);
                $question['incorrect_answer_1'] = $incorrectAnswers[0];
                $question['incorrect_answer_2'] = $incorrectAnswers[1];
                $question['incorrect_answer_3'] = $incorrectAnswers[2];
                $question['explanation'] = $question->explanation->body;
            
        return $question;
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
        if(Gate::allows('isAdvisor') && Gate::allows('canUpdate', $question)) {
            $validatedData = $request->validated();

            DB::beginTransaction();
            try {
                $question->update([
                    'grade_id' => $validatedData['grade_id'],
                    'subject_id' => $validatedData['subject_id'],
                    'body' => $validatedData['body'],
                ]);
        
                // create this question explanation
                ExplanationController::update($question->id, $validatedData['explanation']);
                
                
                // conver incorrect answer to json file
                $incorrectAnswer = array();
                $incorrectAnswer[0] = $validatedData['incorrect_answer_1'];
                $incorrectAnswer[1] = $validatedData['incorrect_answer_2'];
                $incorrectAnswer[2] = $validatedData['incorrect_answer_3'];
                
                $incorrectAnswer = json_encode($incorrectAnswer);
        
                //create answer for this question
                AnswerController::update($question->id, $validatedData['correct_answer'], $incorrectAnswer);
                DB::commit();
                return redirect('/home');
                
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back();
            }
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
        if(Gate::allows('isAdmin')) {
            $question->delete();
            return redirect('/home');
        }
        elseif(Gate::allows('canUpdate', $question)) {
            $question->delete();
            return redirect('/home');
        }
        return redirect()->route('home')->with('success','Delete successfully');
    }
}


// $choise = ['A', 'B', 'C', 'D'];

//             $correctAnswerChoise = rand(0, 3);
//             // conver incorrect answer to json file
//             $incorrectAnswer = array();
//             $count = 1;
//             for ($i=0; $i < 4; $i++) { 
//                 if($i != $correctAnswerChoise) {
//                     $incorrectAnswer[$choise[$i]] = $validatedData['incorrect_answer_'.$count++];
//                 }
//                 else {
//                     $i++;
//                     $incorrectAnswer[$choise[$i]] = $validatedData['incorrect_answer_'.$count++];
//                 }
//             }
//             $incorrectAnswer = json_encode($incorrectAnswer);
//     


/*



<<<<<<< HEAD
            $question = Question::create([
                'user_id'=>auth()->user()->id,
                'grade_id' => $validatedData['grade_id'],
                'subject_id' => $validatedData['subject_id'],
                'body' => $validatedData['body'],
                'is_approved'=>true,
            ]);
    
            Explanation::create([
                'question_id'=>$question->id,
                'body'=>$validatedData['explanation']
            ]);
            // ExplanationController::store($question->id, $validatedData['explanation']);
            
            //select correct answer 
            $incorrectAnswer = array();
            $incorrectAnswer[0] = $validatedData['incorrect_answer_1'];
            $incorrectAnswer[1] = $validatedData['incorrect_answer_2'];
            $incorrectAnswer[2] = $validatedData['incorrect_answer_3'];
            
            $incorrectAnswer = json_encode($incorrectAnswer);
            
            //create answer for this question
            Answer::create([
                'question_id'=>$question->id,
                'correct'=>$validatedData['correct_answer'],
                'incorrect'=>$incorrectAnswer
            ]);
            // AnswerController::store($question->id, $validatedData['correct_answer'], $incorrectAnswer);
            return redirect()->route('home')->with('success','Question Added Successfully');
            // return view (redirect('question.index',)->with('success','Question is Created'));
=======
*/


/*
<<<<<<< HEAD
            $question->update([
                'grade_id' => $validatedData['grade_id'],
                'subject_id' => $validatedData['subject_id'],
                'body' => $validatedData['body'],
            ]);
    
            // create this question explanation
            ExplanationController::update($question->id, $validatedData['explanation']);
            
            // conver incorrect answer to json file
            $incorrectAnswer = array();
            $incorrectAnswer[0] = $validatedData['incorrect_answer_1'];
            $incorrectAnswer[1] = $validatedData['incorrect_answer_2'];
            $incorrectAnswer[2] = $validatedData['incorrect_answer_3'];
            $incorrectAnswer = json_encode($incorrectAnswer);
    
            AnswerController::update($question->id, $validatedData['correct_answer'], $incorrectAnswer);
            
             return redirect()->route('home')->with('success','Update successfully');
            // redirect(route('home'));
=======
*/