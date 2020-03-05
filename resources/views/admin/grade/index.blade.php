@extends('admin.adminbase')

@section('content')
    <div class="container">
        <div class="list-group">
            <p href="#" class="list-group-item list-group-item-action active">
               Grades 
            </p>
            @foreach ($grades as $grade)
                <a href="grade/{{ $grade->id }}" class="list-group-item list-group-item-action"> {{ $grade->id   }}</a>
            @endforeach
        </div>
    </div>
    
@endsection