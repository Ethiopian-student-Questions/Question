@extends('admin.adminbase')
      @section('content')
      <div class="container">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">User Detail</h5>
              <small class="">{{ date('d-m-Y', strtotime($user->created_at))}}</small>
             
            </div>
          
          
      
          <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 text-muted">User Name</h5>
           
            </div>
            
            <h4 class="">{{ $user->user_name }}</h4>
          </a>
      
          <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 text-muted">email</h5>
             
            </div>
            <h4 class="">{{ $user->email }}</h4>
          </a>
      
        </div>
      
      
      
          <hr><br>
        
          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                  
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Questions</h5>
              </div>
             @foreach ($user->questions as $question )
          
     
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
                <div class="btn btn-danger">Delete</div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </a>
      </div>
      </div>
      @endsection