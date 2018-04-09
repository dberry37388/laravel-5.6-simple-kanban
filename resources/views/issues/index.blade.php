@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="d-flex border-bottom mb-4">
                    <div class="mr-auto">
                        <h2>
                            All Issues
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <issues url="/api/issues"></issues>
@endsection
