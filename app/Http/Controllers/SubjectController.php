<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth');
        $subjects = Subject::all();
        return view('admin.subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('auth');
        if(Gate::allows('isAdmin')) {
            return view('admin.subject.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('auth');
        if(Gate::allows('isAdmin')) {
            $request->validate([
                'name' => 'required|string|unique:subjects',
            ]);

            Subject::create([
                'name' => $request->name,
            ]);

            return redirect('/subject');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $subject['questions'] = $this->adjustQuestionAnswerExplanation($subject);
        return view('admin.subject.show', compact('subject'));
    }

    private function adjustQuestionAnswerExplanation($subject)    
    {
        $questions = $subject->questions;
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
    public function edit(Subject $subject)
    {
        $this->middleware('auth');
        if(Gate::allows('isAdmin')) {
            return view('subject.edit', compact('subject'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $this->middleware('auth');
        if(Gate::allows('isAdmin')) {
            $request->validate([
                'name' => 'required|string|unique:subjects,name,'.$this->name,
            ]);

            $subject->update([
                'name' => $request->name,
            ]);

            redirect('/subject');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $this->middleware('auth');
        if(Gate::allows('isAdmin')) {
            $subject->delete();

            redirect('/subject');
        }
    }
}
