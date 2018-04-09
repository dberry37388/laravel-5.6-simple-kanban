@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="mb-4">
                    <h2 class="border-bottom pb-2">Passport Settings</h2>
                </div>

                <div class="mb-3">
                    <passport-clients></passport-clients>
                </div>

                <div class="mb-3">
                    <passport-authorized-clients></passport-authorized-clients>
                </div>

                <div>
                    <passport-personal-access-tokens></passport-personal-access-tokens>
                </div>
            </div>
        </div>
    </div>
@endsection
