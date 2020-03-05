@extends('admin.adminbase')

@section('content')
    <div class="container">
        <div class="list-group">
            <p href="#" class="list-group-item list-group-item-action active">
               Grade {{ $grade->id }}
            </p>
            @foreach ($grade->questions as $question)
                <a href="grade/{{ $grade->id }}" class="list-group-item list-group-item-action"> {{ $question->body   }}</a>
            @endforeach
        </div>
    </div>
@endsection