@extends('admin.adminbase')

@section('content')
<div class="container">
  <div class="list-group">
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">User Detail</h5>
        <small class="text-muted">Join at</small>
      </div>
    
    

    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1 text-muted">User Name</h5>
     
      </div>
      
      <h4 class="">Gutema</h4>
    </a>

    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1 text-muted">email</h5>
       
      </div>
      <h4 class="">bir3gud@gmail.com</h4>
    </a>

  </div>



    <hr><br>
  
    <div class="list-group">
      <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1">Questions</h5>
        </div>
    
  <div id="accordion">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Questino 1
          </button>
        </h5>
      </div>
  
      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
          <li>Choice A</li>
          <li>Choice B</li>
          <li>Choice C</li>
          <li>Choice D</li>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Question 2
          </button>
        </h5>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
          <li>Choice A</li>
          <li>Choice B</li>
          <li>Choice C</li>
          <li>Choice D</li>
        </div>
        <button class="btn btn-danger">delete</button>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingThree">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
           Questino 3
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
          
        </div>
      </div>
    </div>
  </div>
</a>
</div>
</div>
@endsection


{{-- 
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Questions</h5>
    </div>
  

  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Question 1 body</h5>
      <small class="text-muted">Created at</small>
    </div>

  </a>

  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Question 2 body</h5>
      <small class="text-muted">created at</small>
    </div>

   
  </a>

</div> --}}