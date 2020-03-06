@extends('layouts.advisorApp')

@section('content')
    <div class="container">
        <div class="card-body">
          
                    <form method="POST" action="/question">
                        @csrf
                        <div class="form-group row">
                            <label for="grade_id" class="col-md-4 col-form-label text-md-right">{{ __('Grade') }}</label>
                            <div class="col-md-6">
                                 <select class="form-control  @error('grade_id') is-invalid @enderror" name="grade_id" id="grade_id" value="{{ old('grade_id') }}" required>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->id}}</option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="subject_id" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>
                            <div class="col-md-6">
                                 <select class="form-control @error('subject_id') is-invalid @enderror" name="subject_id" id="subject_id" value="{{ old('subject_id') }}" required>
                                  @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" value="{{ old('body') }}" required rows="3"></textarea>
                            </div>
                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group row">
                            <label for="explanation" class="col-md-4 col-form-label text-md-right">{{ __('Explanation') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('explanation') is-invalid @enderror" name="explanation" id="explanation" value="{{ old('explanation') }}" required rows="3"></textarea>
                            </div>
                                @error('explanation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>
                            <div class="col-md-6">
                                <div class="card">
                                  <h5 class="card-header">Answers</h5>
                                  <div class="card-body">
                                    <div>
                                        <label for="correct_answer" class="col-form-label">{{ __('Correct Answer (A)') }}</label>
                                      <input id="correct_answer" type="text" class="form-control @error('correct_answer') is-invalid @enderror" value="{{ old('correct_answer') }}" name="correct_answer" value="{{ old('correct_answer')}}" required autofocus>
                                        @error('correct_answer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="incorrect_answer_1" class="col-form-label">{{ __('Incorrect answer (B)') }}</label>
                                    <input id="incorrect_answer_1" type="text" class="form-control @error('incorrect_answer_1') is-invalid @enderror" value="{{ old('incorrect_answer_1') }}" name="incorrect_answer_1" value="{{old('incorrect_answer_1')}}" required autofocus>
                                        @error('incorrect_answer_1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="incorrect_answer_2" class="col-form-label">{{ __('Incorrect answer (C)') }}</label>
                                    <input id="incorrect_answer_2" type="text" class="form-control @error('incorrect_answer_2') is-invalid @enderror" value="{{ old('incorrect_answer_2') }}" name="incorrect_answer_2" value="{{old('incorrect_answer_2')}}" required autofocus>
                                        @error('incorrect_answer_2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="incorrect_answer_3" class="col-form-label">{{ __('Incorrect answer (D)') }}</label>
                                    <input id="incorrect_answer_3" type="text" class="form-control @error('incorrect_answer_3') is-invalid @enderror" value="{{ old('incorrect_answer_3') }}" name="incorrect_answer_3" value="{{old('incorrect_answer_3')}}" required autofocus>
                                        @error('incorrect_answer_3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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