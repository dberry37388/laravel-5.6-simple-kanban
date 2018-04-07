@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        #{{ $issue->id }} - {{ $issue->title }}
                    </div>

                    <div class="card-body">
                        <div class="issueMetaData">
                            <small>
                                Created by <a href="#">{{ $issue->creator->name }}</a>
                                {{ $issue->created_at->diffForHumans() }} in
                                <a href="{{ route('showLane', $issue->lane) }}">{{ $issue->lane->title }}</a>
                            </small>
                        </div>

                        <hr>

                        <div class="issue-description-full">
                            {!! nl2br(htmlspecialchars($issue->description)) !!}
                        </div>

                    </div>

                    @can('delete', $issue)
                        <div class="card-footer text-muted d-flex">

                            <a href="{{ route('editIssue', $issue) }}" class="btn btn-secondary btn-sm">Update</a>
                            <div class="d-inline">
                                <form action="{{ route('deleteIssue', $issue) }}" method="post">
                                    @method('delete')
                                    @csrf

                                    <button class="btn btn-sm btn-link text-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
