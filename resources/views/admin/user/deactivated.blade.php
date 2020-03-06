@extends('admin.adminbase')

@section('content')
<div class="container">
  <div class="list-group">
    <p href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
      <div class="d-flex w-100 justify-content-between">
        <h1>Deactivated Users</h1>
      </div>
    </p>
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
