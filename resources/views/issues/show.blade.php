@extends('layouts.app')

@section('content')
    <h1>{{ $issue->title }}</h1>

    <p>
        {{ $issue->description }}
    </p>
@endsection