@extends('layouts.advisorApp')

@section('content')
      <div class="container">
            @if ($questions->count() > 0)
                  @foreach ($questions as $question )
                  <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                              
                              <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Questions</h5>
                              </div>
                              <div id="accordion">
                                    <div class="card">
                                          <div class="card-header" id="headingThree">
                                                <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                {{ $question->body }}
                                                </button>
                                                </h5>
                                          </div>
                                          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                <div class="card-body">
                                                      <div class="container">
                                                            <p>A. {{$question->correctAnswer}} <span class="ml-3 right badge badge-success">correct answer</span></p>
                                                            <p>B. {{$question->incorrectAnswer[0]}}</p>
                                                            <p>C. {{$question->incorrectAnswer[1]}}</p>
                                                            <p>D. {{$question->incorrectAnswer[2]}}</p>
                                                      </div>
                                                </div>
                                                <div class="card-body">
                                                      <div class="container mt-2">
                                                            <p class="text-primary">Explanation</p>
                                                            <p>{{ $question->explanation}}</p>
                                                      </div>
                                                </div>
                                                <form action="/question/{{ $question->id }}" class="mt-3" method="post">
                                                      @csrf
                                                      {{ method_field('DELETE') }}
                                                      <button type="submit" class="btn btn-danger">delete</button>
                                                  </form>
                                          </div>
                                    </div>
                              </div>
                        </a>
                  </div>
            @endforeach
            @else
                  <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                              
                              <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Questions</h5>
                              </div>
                              <div id="accordion" class="mb-4 mr-2 ml-2">
                                    <div class="card">
                                          <p class="text-danger mt-3 offset-4 font-weight-bold">No question posted yet.</p>
                                    </div>
                              </div>
                        </a>
                  </div>
            @endif
      </div>
@endsection