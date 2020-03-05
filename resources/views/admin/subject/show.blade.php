@extends('admin.adminbase')

@section('content')
    <div class="container">
        <div class="list-group">
            <p href="#" class="list-group-item list-group-item-action active">
               {{ ucwords($subject->name) }} 
            </p>
            @foreach ($subject->questions as $question)
                <a href="subject/{{ $question->id }}" class="list-group-item list-group-item-action"> {{ $question->body  }}</a>
            @endforeach
        </div>
    </div>
@endsection