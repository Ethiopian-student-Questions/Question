<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Question;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\QuestionRequest;
use App\Subject;
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
        $this->middleware('auth');
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
                redirect()->back();
            }
        }

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
            $grades = Grade::all();
            $subjects = Subject::all();
            $question = $this->adjustQuestionAnswerExplanation($question);
            return view('question.edit', compact('question', 'subjects', 'grades'));
        }
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
    }
}
