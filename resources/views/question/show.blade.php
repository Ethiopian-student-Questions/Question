@extends('layouts.advisorApp')

@section('content')
      <div class="container">
          
                    <form method="POST" action="/question/{{$question->id}}">
                        @csrf
                        @method('put')
                           <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Grade') }}</label>
                            <div class="col-md-6">
                            	 <select class="form-control" name="grade_id" id="" required>
                            	 	<option value="{{$current_grade->id}}">{{$current_grade->id}}</option>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->id}}</option>
                                    @endforeach
							    </select>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>
                            <div class="col-md-6">
                            	 <select class="form-control" name="subject_id" id="" required>
                            	 	<option value="{{$current_subject->id}}">{{$current_subject->name}}</option>
							      @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                    @endforeach
							    </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="body" id="" required rows="3">{{$question->body}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Explanation') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="explanation" id=""  required rows="3">{{$question->explanation->body}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                 			<label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>
                            <div class="col-md-6">
                                <div class="card">
								  <h5 class="card-header">Answers</h5>
								  <div class="card-body">
								  	<div>
									  	<label for="correct_answer" class="col-form-label">{{ __('Correct Answer (A)') }}</label>
									    <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="correct_answer" value="{{$question->answer->correct}}" required autofocus>
								    </div>
								    <div>
									  	<label for="user_name" class="col-form-label">{{ __('Incorrect answer (B)') }}</label>
									    <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="incorrect_answer_1" value="{{$incorrect[0]}}" required autofocus>
								    </div>
								    <div>
									  	<label for="user_name" class="col-form-label">{{ __('Incorrect answer (C)') }}</label>
									    <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="incorrect_answer_2" value="{{$incorrect[1]}}" required autofocus>
								    </div>
								    <div>
									  	<label for="user_name" class="col-form-label">{{ __('Incorrect answer (D)') }}</label>
									    <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="incorrect_answer_3" value="{{$incorrect[2]}}" required autofocus>
								    </div>

								  </div>
								</div>
							</div>
                        </div>

                   
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>

                             
                            </div>
                        </div>
                    </form>
      </div>
@endsection