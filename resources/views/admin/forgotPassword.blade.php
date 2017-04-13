@extends('layouts.admin-master-basic')

@section('content')
  <div class="login-box-body">
    <p class="login-box-msg">{{trans('admin.reset_password_link_set_title')}}</p>
    <form action="{{url('/admin/forgot-password')}}" method="post" enctype="form-multipart/form-data" id="password_link">
      {{csrf_field()}}
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" maxlength="100">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="password_link_submit">{{trans('label.reset')}}</button>
        </div>
      </div>
    </form>
    <a href="{{url('admin/login')}}" class="text-center"{{trans('label.back_login')}}></a>
  </div>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/front/jquery.validate.min.js') }}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      var passwordRules = {
          email : {
            required : true,
            email : true,
            maxlength : 100,
          }
      };
      $("#password_link").validate({
          rules: passwordRules,
          messages: {
              email: {
                  required: "<?php echo trans('validation.emailrequiredfield'); ?>",
                  maxlength: "<?php echo trans('validation.emailmaxlength'); ?>",
                  email : "<?php echo trans('validation.validemailfield'); ?>",
              },
          }
      });
      $("#password_link_submit").click(function(){
        var form = $("#password_link");
        form.validate();
        if(form.valid())
        {
          form.submit();
          $("#password_link_submit").attr("disabled", 'disabled');
        }
        else
        {
          $("#password_link_submit").removeAttr("disabled", 'disabled');
        }
      });
    });
  </script>
@endsection