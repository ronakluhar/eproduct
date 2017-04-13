@extends('layouts.master-basic')

@section('content')
<section class="sign_up_step">
    <div class="container">
        <div class="sign_up_view clearfix">
            <div class="sign_up_header">
                <h2><span>Forgot</span> Password?</h2>
                <p>Password reset instructions have been emailed to [ insert user's email address]. This may take a minute. If you still haven't received your activation email, enter your email below and we'll send you another.</p>
            </div><!-- sign_up_header End -->

            <form id="forgotPassword" action="{{url('forgot-password')}}" method="POST">
                {{ csrf_field() }}
                <div class="form-group E_mail clearfix">
                  <label>Email Address :</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="100">
                  <div class="pull-right sub_step">
                    <button id="login_submit">Send</button>
                  </div>
                </div>
            </form>
        </div><!-- sign_up_view End -->
    </div>
</section>
@endsection

@section('script')
  <script type="text/javascript">
    jQuery(document).ready(function() {
          var loginRules = {
              email: {
                  required: true,
                  email: true,
                  maxlength : 100
              }
          };
          $("#forgotPassword").validate({
              rules: loginRules,
              messages: {
                  email: {required: "<?php echo trans('validation.emailrequiredfield') ?>",
                    email: "<?php echo trans('validation.validemailfield'); ?>"
                  }
              }
          });

          $("#forgotPassword").click(function(){
            var form = $("#forgotPassword");
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