<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grade;


class GradeController extends Controller    
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::all();
        return view('admin.grade.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        $grade['questions'] = $this->adjustQuestionAnswerExplanation($grade);
        return view('admin.grade.show', compact('grade'));
    }

    private function adjustQuestionAnswerExplanation($grade)    
    {
        $questions = $grade->questions;
        foreach ($questions as $question) {

                $answer = $question->answer;
                $question['correctAnswer'] = $answer->correct;
                $question['incorrectAnswer'] = json_decode($answer->incorrect, true);
                $question['explanation'] = $question->explanation->body;
                
            }
        return $questions;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect('/grade');
    }
}
