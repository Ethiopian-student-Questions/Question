@extends('admin.adminbase')

@section('content')
    <div class="container">
        <div class="list-group ml-5 mr-5">
            <p href="#" class="list-group-item list-group-item-action active">
               Grades 
            </p>
            @foreach ($grades as $grade)
                    <a href="{{ route('grade.show', $grade->id) }}" class="list-group-item list-group-item-action"> 
                        {{ $grade->id   }} 
                        <span class="badge badge-primary float-right badge-pill">{{ $grade->questions->count() }} questions</span>
                    </a>
            @endforeach
        </div>
    </div>
    
@endsection