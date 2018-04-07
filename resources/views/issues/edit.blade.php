@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        Edit Issue #{{ $issue->id }}
                    </div>

                    <div class="card-body">
                        <form action="{{ route('updateIssue', $issue) }}" method="post">
                            <!-- Title -->
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="title" name="title"
                                           placeholder="Title" value="{{ old('title', $issue->title) }}" required>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="description" id="description" rows="5"
                                              placeholder="Enter a description for this issue."
                                    >{{ old('description', $issue->description) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Update Issue</button>
                                </div>
                            </div>

                            @method('put')
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection