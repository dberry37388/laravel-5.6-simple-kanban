@extends('layouts.app')

@section('content')
    @foreach($issues as $issue)
        <div class="issue">
            <h1>{{ $issue->title }}</h1>

            <p>
                {{ $issue->description }}
            </p>
        </div>
    @endforeach
@endsection