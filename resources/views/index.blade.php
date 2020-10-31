@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Dashboard')}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="title m-b-md text-center">
            <h5>{{ __('Welcome') }}</h5>
        </div>
    @endauth
</div>
@endsection