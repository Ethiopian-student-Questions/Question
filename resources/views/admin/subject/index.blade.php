@extends('admin.adminbase')

@section('content')
    <div class="container">
        <div class="list-group">
            <p href="#" class="list-group-item list-group-item-action active">
               Subjects 
               <a href="/subject/create" class="float-right btn btn-success"> Add Subject</a href="/subject/create">
            </p>
            @foreach ($subjects as $subject)
                <a href="subject/{{ $subject->id }}" class="list-group-item list-group-item-action"> {{ $subject->name  }}</a>
            @endforeach
        </div>
    </div>
@endsection