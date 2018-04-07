@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($issues as $issue)
                    <div class="card mb-3">
                        <div class="card-header">
                            <a href="{{ route('showIssue', $issue) }}">
                                #{{ $issue->id }} - {{ $issue->title }}
                            </a>
                        </div>

                        <div class="card-body">
                            {{ $issue->description }}
                        </div>

                        <div class="card-footer text-muted">
                            <small>
                                Created by <a href="#">{{ $issue->creator->name }}</a> {{ $issue->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection