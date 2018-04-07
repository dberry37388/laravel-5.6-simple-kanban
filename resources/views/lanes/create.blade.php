@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        Create a New Lane
                    </div>

                    <div class="card-body">
                        <form action="{{ route('storeLane') }}" method="post">
                            <!-- Title -->
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="title" name="title"
                                           placeholder="Title" value="{{ old('title') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Create Lane</button>
                                </div>
                            </div>

                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
