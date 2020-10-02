@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif

                    <div  class="title m-b-md">
                        {{ $details['title'] }}
                    </div>

                    <div class="title m-b-md">
                       {{ $details['body'] }}
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection