@extends('layouts.master-basic')

@section('content')

<div class="col-xs-12">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>{{trans('validation.whoops')}}</strong> {{trans('validation.someproblems')}}<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<div class="centerlize">
    <div class="container">
            <div class="clearfix col-md-offset-2 col-sm-offset-1 col-md-8 col-sm-10 detail_container">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <p class="login-box-msg">{{ $varifymessage }}</p>
                    <a href="{{ url('/login') }}" class="btn primary_btn"><em>Login</em><span></span></a>
                </div>
            </div>
    </div>
</div>
@stop
