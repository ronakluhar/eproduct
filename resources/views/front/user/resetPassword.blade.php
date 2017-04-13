@extends('layouts.master-basic')

@section('content')
<section class="sign_up_step">
      <div class="container">
        <div class="sign_up_view clearfix">
          <div class="sign_up_header">
            <h2><span>Reset</span> Password?</h2>
            <p>Select your new password and enter it below.</p>
          </div><!-- sign_up_header End -->

          <form id="resetPassword" action="{{url('reset-password')}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="id" id="id" value="{{$id}}"/>
            <input type="hidden" name="token" id="token" value="{{$token}}"/>
            <div class="form-group E_mail clearfix">
              <div class="">
                <label>New Password :</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="New Password" maxlength="20">
              </div>
              <div class="">
                <label>Confirm Password :</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" maxlength="20">
              </div>
              <div class="pull-right sub_step">
                <button id="login_submit">Send</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
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
              confirm_password: {
                  required: true,
                  equalTo: '#password'
              },
          };
          $("#resetPassword").validate({
              rules: loginRules,
              messages: {
                  password: {
                    required: "<?php echo trans('validation.passwordrequiredfield'); ?>"
                  },
                  confirm_password: {
                      required: "<?php echo trans('validation.confirmpasswordrequiredfield'); ?>",
                      equalTo: "<?php echo trans('validation.passwordnotmatch'); ?>"
                  },
              }
          });

          $("#resetPassword").click(function(){
            var form = $("#resetPassword");
            form.validate();
            if (form.valid()) {
                form.submit();
                $("#login_submit").attr("disabled", 'disabled');
            } else {
                $("#login_submit").removeAttr("disabled", 'disabled');
            }
        });
    });
  </script>
@endsection