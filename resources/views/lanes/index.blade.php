@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($issues as $issue)
                    <div class="card mb-3">
                        <div class="card-header d-flex">
                            <div class="mr-auto">
                                <a href="{{ route('showIssue', $issue) }}">
                                    #{{ $issue->id }} - {{ $issue->title }}
                                </a>
                            </div>

                            @can('update', $issue)
                                <div>
                                    <a href="{{ route('editIssue', $issue) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            @endcan
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

                            <div class="issue-description-preview">
                                {{ str_limit($issue->description, 300) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
