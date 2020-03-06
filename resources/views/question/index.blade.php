@extends('layouts.advisorApp')

@section('content')
      <div class="container">
            @if ($questions->count() > 0)
                  
                  <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                              
                              <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Questions</h5>
                              </div>
                              <div id="accordion">
                                    <div class="card">
                                          @foreach ($questions as $question )
                                          <div class="card-header mb-2" id="headingThree">
                                                <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree{{$question->id}}" aria-expanded="false" aria-controls="collapseThree{{$question->id}}">
                                                {{ $question->body }}
                                                </button>
                                                </h5>
                                          </div>
                                          <div id="collapseThree{{$question->id}}" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
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
                                                <div class="row m-3">
                                                       <form action="/question/{{ $question->id }}" class="m-3" method="GET">
                                                      @csrf
                                                      {{-- {{ method_field('PUT') }} --}}
                                                      <button type="submit" class="btn btn-primary">Edit</button>
                                                </form>
                                                 <form action="/question/{{ $question->id }}" class="m-3" method="post">
                                                      @csrf
                                                      {{ method_field('DELETE') }}
                                                      <button type="submit" class="btn btn-danger">delete</button>
                                                </form>
                                               
                                                </div>
                                                
                                          </div>
                                          @endforeach
                                    </div>
                              </div>
                        </a>
                  </div>
            
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