@extends('layouts.admin-master-basic')

@section('content')
    <div class="login-box-body">
      <p class="login-box-msg">{{trans('admin.signin_to_strart_session')}}</p>
      <form id="login_form" class="form-horizontal" role="form" action="{{url('/admin/login')}}" method="POST" autocomplete="off">
      {{ csrf_field() }}
        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
          <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" maxlength="100">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
          <input type="password" class="form-control" placeholder="Password" name="password" maxlength="20">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
        </div>
        <div class="">
          
          <div class="col-xs-4 pull-right">
            <button type="submit" class="btn btn-primary btn-block btn-flat" id="login_submit">{{trans('label.signin')}}</button>
          </div>
        </div>
      </form>
     
    </div>
  </div>
@endsection

@section('script')
  <script src="{{ asset('js/front/jquery.validate.min.js') }}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
          var loginRules = {
              password: {
                  required: true,
                  minlength: 6,
                  maxlength: 20
              },
              email : {
                required : true,
                email : true,
                maxlength : 100,
              }
          };
          $("#login_form").validate({
              rules: loginRules,
              messages: {
                  password: {required: "<?php echo trans('passwords.required'); ?>",
                      maxlength: "<?php echo trans('validation.passwordmaxlength'); ?>",
                      minlength: "<?php echo trans('validation.passwordminlength'); ?>"
                  },
                  email: {required: "<?php echo trans('validation.emailrequiredfield'); ?>",
                      maxlength: "<?php echo trans('validation.emailmaxlength'); ?>",
                      email : "<?php echo trans('validation.validemailfield'); ?>",
                  },
              }
          });

          $("#login_submit").click(function(){
            var form = $("#login_form");
            form.validate();
            if(form.valid())
            {
              form.submit();
              $("#login_submit").attr("disabled", 'disabled');
            }
            else
            {
              $("#login_submit").removeAttr("disabled", 'disabled');
            }
          });
    });
  </script>
@endsection