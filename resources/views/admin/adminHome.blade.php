@extends('admin.adminbase')

@section('content')
<div class="container">
  <div class="list-group">
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
      <div class="d-flex w-100 justify-content-between">
        <h1>Users</h1>
      </div>
    </a>
    @foreach ($users as $user)
      <a href="/user/{{ $user->id }}" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1">{{ $user->user_name }}</h5>
        </div>
        <small class="text-muted font-weight-bold">{{ $user->email }}</small>
      </a>          
    @endforeach
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