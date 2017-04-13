@extends('layouts.admin-master-basic')

@section('content')
  <div class="login-box-body">
    @if(isset($forgotToken) && $forgotToken != '')
      <p class="login-box-msg">{{trans('admin.set_new_password')}}</p>
      <form action="{{ url('/admin/reset-password') }}" method="post" enctype="form-multipart/form-data" id="reset_password_form">
        {{csrf_field()}}
        <div class="form-group has-feedback">
          <input type="hidden" name="forgot_token" value="{{Session::get('password_token_admin') , ''}}" />
          <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
              <input type="password" class="form-control" id="password" name="password" placeholder="New Password" value="{{ old('password') }}">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
          </div>
        </div>
        <div class="row">
          <div class="col-xs-7">

          </div>
          <div class="col-xs-5">
            <button type="submit" class="btn btn-primary btn-block btn-flat" id="reset_password_submit">{{trans('label.set_password')}}</button>
          </div>
        </div>
      </form>
    @else
      <div class="panel-heading"><center>{{trans('passwords.forgot_password_request_not_found')}}</center></div><br/>
    @endif
    <a href="{{url('admin/login')}}" class="text-center">{{trans('label.back_login')}}</a>
  </div>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/front/jquery.validate.min.js') }}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      var passwordRules = {
          password : {
            required : true,
            minlength: 6,
            maxlength : 20,
          }
      };
      $("#reset_password_form").validate({
          rules: passwordRules,
          messages: {
              password: {
                  required: "<?php echo trans('passwords.required'); ?>",
                  maxlength: '<?php echo trans('validation.passwordmaxlength'); ?>',
                  minlength: '<?php echo trans('validation.passwordminlength'); ?>'
              },
          }
      });
      $("#reset_password_submit").click(function(){
          var form = $("#reset_password_form");
          form.validate();
          if(form.valid())
          {
              form.submit();
              $("#reset_password_submit").attr("disabled", 'disabled');
          }
          else
          {
              $("#reset_password_submit").removeAttr("disabled", 'disabled');
          }
      });

    });
  </script>
@endsection