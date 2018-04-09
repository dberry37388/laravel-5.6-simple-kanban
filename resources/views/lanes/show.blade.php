@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="d-flex border-bottom mb-4">
                    <div class="mr-auto">
                        <h2>
                            {{ $lane->title }}
                        </h2>
                    </div>

                    @can('update', $lane)
                        <div>
                            <span class="align-middle">
                                <a href="{{ route('editLane', $lane) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </span>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <issues url="/api/lanes/{{ $lane->id }}/issues"></issues>
@endsection
