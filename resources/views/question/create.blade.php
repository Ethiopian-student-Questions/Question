@extends('layouts.advisorApp')

@section('content')
	<div class="container">
		<div class="card-body">
                    <form method="POST" action="{{ route('question') }}">
                        @csrf

                           <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Grade') }}</label>
                            <div class="col-md-6">
                            	 <select class="form-control" name="grade_id" id="exampleFormControlSelect1">
							      <option>1</option>
							      <option>2</option>
							      <option>3</option>
							      <option>4</option>
							      <option>5</option>
							    </select>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>
                            <div class="col-md-6">
                            	 <select class="form-control" name="subject_id" id="exampleFormControlSelect1">
							      <option>1</option>
							      <option>2</option>
							      <option>3</option>
							      <option>4</option>
							      <option>5</option>
							    </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="body" id=""  rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Explanation') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="explanation" id=""  rows="3"></textarea>
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
									    <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="correct_answer" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>
								    </div>
								    <div>
									  	<label for="user_name" class="col-form-label">{{ __('Incorrect answer (B)') }}</label>
									    <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="incorrect_answer_1" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>
								    </div>
								    <div>
									  	<label for="user_name" class="col-form-label">{{ __('Incorrect answer (C)') }}</label>
									    <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="incorrect_answer_2" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>
								    </div>
								    <div>
									  	<label for="user_name" class="col-form-label">{{ __('Incorrect answer (D)') }}</label>
									    <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required autocomplete="incorrect_answer_3" autofocus>
								    </div>

								  </div>
								</div>
							</div>
                        </div>

                   
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>

                             
                            </div>
                        </div>
                    </form>
                </div>
            </div>
	</div>
@endsection


{{-- 
 'grade_id' => 'digits_between:min=5,max=13|required',
            'subject_id' => 'required|integer',
            'body' => 'required|string',
            'explanation' => 'required|string',
            'correct_answer' => 'required|string',
            'incorrect_answer_1' => 'required|string',
            'incorrect_answer_2' => 'required|string',
            'incorrect_answer_3' => 'required|string',
        ]; --}}