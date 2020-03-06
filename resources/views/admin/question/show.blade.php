@extends('admin.adminbase')
@section('content')

    <div class="container">
            @if ($user->questions->count() > 0)
                @foreach ($user->questions as $question )
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
                                <li>Choice A</li>
                                <li>Choice B</li>
                                <li>Choice C</li>
                                <li>Choice D</li>
                              </div>
                              <div class="btn ml-3 btn-danger">Delete</div>
                            </div>
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