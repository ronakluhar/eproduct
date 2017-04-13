@extends('layouts.master-basic')

@section('content')
<div class="login_area">
    <div class="login_content">
        <div class="logo">
        </div>
        <div class="login_tabbing">
          <ul class="nav nav-tabs">
             <li class="{{Request::is('login') ? 'active' : ''}}"><a data-toggle="tab" href="#home" id="login" title="{{trans('label.lblheadlogin')}}" alt="{{trans('label.lblheadlogin')}}">{{trans('label.lblheadlogin')}}</a></li>
             <li class="{{Request::is('signup') ? 'active' : ''}}"><a data-toggle="tab" href="#menu1" id="signup" title="{{trans('label.lblheadsignup')}}" alt="{{trans('label.lblheadsignup')}}">{{trans('label.lblheadsignup')}}</a></li>
          </ul>
          <div class="tab-content">
            <div id="home" class="tab-pane fade {{Request::is('login') ? 'in active' : ''}}">
                @include('front/user/login')
            </div>
            <div id="menu1" class="tab-pane fade {{Request::is('signup') ? 'in active' : ''}}">
                @include('front/user/signup')
            </div>
          </div>
        </div>
    </div>
</div>

@endsection
@section('script')

<script type="text/javascript">

    var validationRules = {
                first_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 20
                },
                last_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 20
                },
                username: {
                    required: true,
                    maxlength: 20,
                    minlength:6
                },
                email: {
                    required: true,
                    email: true,
                    maxlength:100
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
                phone: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 11
                },
            }

        $("#signup_form").validate({
            rules: validationRules,
            messages: {
                first_name: {
                    required: "<?php echo trans('validation.firstnamerequiredfield'); ?>",
                    maxlength: '<?php echo trans('validation.firstnamemaxlength'); ?>',
                    minlength: '<?php echo trans('validation.firstnameminlength'); ?>'
                },
                last_name: {
                    required: "<?php echo trans('validation.lastnamerequiredfield'); ?>",
                    maxlength: '<?php echo trans('validation.lastnamemaxlength'); ?>',
                    minlength: '<?php echo trans('validation.lastnameminlength'); ?>'
                },
                username: {
                    required: "<?php echo trans('validation.usernamerequiredfield') ?>",
                    maxlength: "<?php echo trans('validation.usernamemaxlength') ?>",
                    minlength: "<?php echo trans('validation.usernameminlength') ?>"
                },
                email: {
                    required: "<?php echo trans('validation.emailrequiredfield') ?>",
                    email: "<?php echo trans('validation.validemailfield'); ?>",
                    maxlength: "<?php echo trans('validation.emailmaxlength') ?>"
                },
                password: {
                    required: "<?php echo trans('validation.passwordrequiredfield'); ?>",
                    maxlength: '<?php echo trans('validation.passwordmaxlength'); ?>',
                    minlength: '<?php echo trans('validation.passwordminlength'); ?>'
                },
                phone: {
                    required: "<?php echo trans('validation.phonerequiredfield'); ?>",
                    digits: "<?php echo trans('validation.validphoneno'); ?>"
                },
            }
        });

        $("#signup_submit").click(function(){
            var form = $("#signup_form");
            form.validate();
            if (form.valid()) {
                form.submit();
                $("#signup_submit").attr("disabled", 'disabled');
            } else {
                $("#signup_submit").removeAttr("disabled", 'disabled');
            }
        });


        function passwordStrength(password){
        	var desc = new Array();
        	desc[1] = "Weak";
        	desc[2] = "Better";
        	desc[3] = "Medium";
        	desc[4] = "Strong";
        	desc[5] = "Strongest";

            if (password == '') {
                $('#passwordDescription').text(" ");
                document.getElementById("passwordStrength").className = "strength" + 0;
            }
        	var score   = 1;
            if (password.length > 1) {
            	if (password.length > 6) score++;
                if ( ( password.match(/[a-z]/) ) && ( password.match(/[A-Z]/) ) ) score++;
                if (password.match(/\d+/)) score++;
                if ( password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) )	score++;
                if (password.length > 12) score++;

            	$('#passwordDescription').text(desc[score]);
            	document.getElementById("passwordStrength").className = "strength" + score;
            }
        }

        var loginRules = {
              password: {
                  required: true,
                  minlength: 6,
                  maxlength: 20
              }
          };
          $("#login_form").validate({
              rules: loginRules,
              messages: {
                    password: {required: "<?php echo trans('validation.passwordrequiredfield'); ?>",
                    maxlength: "<?php echo trans('validation.passwordmaxlength'); ?>",
                    minlength: "<?php echo trans('validation.passwordminlength'); ?>"
                  }
              }
          });

        $("#login_submit").click(function(){
            var form = $("#login_form");
            form.validate();
            var validEmailOrUserName = false;
            $('#email_username_invalid').show();
            var emailOrUserName = $.trim($("#email").val());

            if (emailOrUserName.length > 0 && emailOrUserName.match(/[a-zA-Z]/i))
            {
                if(emailOrUserName.indexOf("@") > -1)
                {
                    if (validateEmail(emailOrUserName))
                    {
                        var validEmailOrUserName = true;
                    }
                }
                else {
                    if (emailOrUserName.length > 6) {
                        var validEmailOrUserName = true;
                    }
                }
            }

            if (validEmailOrUserName) {
                $('#email_username_invalid').hide();
                if (form.valid()) {
                    form.submit();
                    $("#login_submit").attr("disabled", 'disabled');
                } else {
                    $("#login_submit").removeAttr("disabled", 'disabled');
                }
                return true;
            } else {
                $('#email_username_invalid').show();
                return false;
            }
        });

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    $(function() {
      var loc = window.location.href; // returns the full URL
      if(/login/.test(loc)) {
        $('#home').addClass('active in ');
        $('#menu1').removeClass('in active');
      }
      if(/signup/.test(loc)) {
        $('#menu1').addClass('active in ');
        $('#home').removeClass('in active');
      }
    });

    $('#login').click(function () {
        window.location.replace("login");
        return false;
    });
    $('#signup').click(function () {
        window.location.replace("signup");
        return false;
    });

    //Password hide/show functionality
    $(".hide-password").click(function() {
        var pass_input = $(this).siblings('.password_hide_show');
        if($(this).text() == 'Show')
        {
             pass_input.attr({type: 'text'});
             $(this).text("Hide");
        }else{
             pass_input.attr({type: 'password'});
             $(this).text("Show");
        }
    });

    //enter only character in textbox
    $('.alphaonly').bind('keyup blur',function(){
        var node = $(this);
        node.val(node.val().replace(/[^a-z ^A-Z]/g,'') ); }
    );

    $('.numeric').bind('keyup blur',function(){
        var node = $(this);
        node.val(node.val().replace(/[^0-9]/g,'') ); }
    );

    $('.alphaonly_username').bind('keyup blur',function(){
        var node = $(this);
        node.val(node.val().replace(/[^a-z ^A-Z ^0-9 ^_]/g,'') ); }
    );
</script>
@stop