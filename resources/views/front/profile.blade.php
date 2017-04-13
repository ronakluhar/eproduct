@extends('layouts.master-basic')

@section('header')
<link rel="stylesheet" href="{{asset('css/front/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{asset('css/front/jquery.mCustomScrollbar.css')}}">
<link href="{{asset('css/front/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/front/jquery-ui.min.css')}}" rel="stylesheet" type="text/css">
@endsection        

@section('content')

<section class="profile_section">
    <div class="container">
        <div class="tabber">
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12  profile_right">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#settings">Account Settings</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="settings" class="tab-pane fade in active">
                            <div class="box_cst">
                                <ul class="nav nav-tabs dry">
                                    <li class="active"><a data-toggle="tab" href="#profileSettings">Profile</a></li>
                                    <li><a data-toggle="tab" href="#password">Password</a></li>
                                </ul>
                                <div class="tab-content dry">
                                    <div id="profileSettings" class="tab-pane fade in active">
                                        <form class="cst_form" id="profile_setting_form" enctype="multipart/form-data" method="POST" action="{{ url('/profile_setting') }}">
                                            {{csrf_field()}}
                                            <h4>Your profile</h4>
                                            
                                            <?php
                                            if (old('first_name')) {
                                                $first_name = old('first_name');
                                            } else if (isset($userDetail->first_name)) {
                                                $first_name = $userDetail->first_name;
                                            } else {
                                                $first_name = "";
                                            }
                                            ?>
                                            <div class="form-group">
                                                <label for="first_name">{{trans('label.lblfirstname')}}:</label>
                                                <input type="text" class="form-control alphaonly" id="first_name" name="first_name" value="{{$first_name}}" size="20" maxlength="20"/>
                                            </div>
                                            <?php
                                            if (old('last_name')) {
                                                $last_name = old('last_name');
                                            } else if (isset($userDetail->last_name)) {
                                                $last_name = $userDetail->last_name;
                                            } else {
                                                $last_name = "";
                                            }
                                            ?>
                                            <div class="form-group">
                                                <label for="last_name">{{trans('label.lbllastname')}}:</label>
                                                <input type="text" class="form-control alphaonly" id="last_name" name="last_name" value="{{$last_name}}" size="20" maxlength="20"/>
                                            </div>

                                            <div class="form-group">
                                                <label for="userName">{{trans('label.lblusername')}}:</label>
                                                <input type="text" class="form-control alphaonly_username" id="username" name="username" value="{{$userDetail->username}}" readonly />
                                            </div>
                                            <div class="form-group">
                                                <label for="email">{{trans('label.lblemail')}}:</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{$userDetail->email}}" readonly />
                                            </div>
                                            <?php
                                            if (old('phone')) {
                                                $phone = old('phone');
                                            } elseif ($userDetail) {
                                                $genphoneder = $userDetail->phonephone;
                                            } else {
                                                $phone = 1;
                                            }
                                            ?>
                                            <div class="form-group">
                                                <label for="phone">{{trans('label.usertblheadphone')}}:</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{$userDetail->phone}}" size="20" maxlength="12"/>
                                            </div>
                                            <?php
                                            if (old('gender')) {
                                                $gender = old('gender');
                                            } elseif ($userDetail) {
                                                $gender = $userDetail->gender;
                                            } else {
                                                $gender = 1;
                                            }
                                            ?>
                                            <div class="form-group">
                                                <label for="fullName">{{trans('label.gender')}}:</label>
                                                <input type="radio" id="f-option" name="gender" value="1" @if($gender == 1){{"checked='checked'"}} @endif>
                                                       <label for="f-option">{{trans('label.lblmale')}}</label>
                                                <span id="gender_error_msg"></span>
                                                <input type="radio" id="s-option" name="gender" value="2" @if($gender == 2){{"checked='checked'"}}@endif>
                                                       <label for="s-option">{{trans('label.lblfemale')}}</label>
                                            </div>
                                            <div class="footer_form">
                                                <button type="button" class="btn btn-warning">Cancel</button>
                                                <button type="submit" class="btn btn-primary" id="profile_setting_form_submit">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                    <div id="password" class="tab-pane fade">
                                        <form class="cst_form" id="change_password_form" enctype="multipart/form-data" method="POST" action="{{ url('/change_password') }}">
                                            {{csrf_field()}}
                                            @if($userDetail->password != "")
                                            <h4>{{trans('label.changepassword')}}</h4>
                                            <div class="form-group">
                                                <label for="currentPwd">{{trans('label.currentpassword')}} :</label>
                                                <input type="password" class="form-control" id="currentPwd" name='currentPwd' value="{{old('currentPwd')}}">
                                            </div>
                                            @else
                                            <h4>{{trans('label.setpassword')}}</h4>
                                            @endif
                                            <div class="form-group">
                                                <label for="newPwd">{{trans('label.newpassword')}} :</label>
                                                <input type="password" class="form-control" id="newPwd" name="password" value="{{old('password')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="verifyCurrentPwd">{{trans('label.verifypassword')}} :</label>
                                                <input type="password" class="form-control" id="verifyCurrentPwd" name='confirm_password' value="{{old('confirm_password')}}">
                                            </div>
                                            <div class="footer_form">
                                                <button type="button" class="btn btn-warning">Cancel</button>
                                                <button type="submit" class="btn btn-primary" id="change_password_form_submit">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script src="{{asset('js/front/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/front/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/front/owl.carousel.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function ($) {
        $(".sign_login .login_btn").click(function () {
            $(".register-poup").slideToggle("slow");
            $(this).toggleClass("active");
        });
    });

    $(window).load(function () {
        // image upload
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_upload_default').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("body").on("change", ".uplod_btn", function () {
            readURL(this);
        });

    });

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
        gender: {
            required: true
        },
    }

    $("#profile_setting_form").validate({
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
            gender: {
                required: "<?php echo trans('validation.genderquiredfield'); ?>"
            },
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "gender") {
                error.appendTo("#gender_error_msg");
            } else {
                error.insertAfter(element)
            }
        }
    });
    <?php if ($userDetail->password != "") { ?>
        var loginRules = {
            password: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            currentPwd: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            confirm_password: {
                required: true,
                equalTo: '#newPwd',
                minlength: 6,
                maxlength: 20
            },
        };
        <?php } else { ?>
        var loginRules = {
            password: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            confirm_password: {
                required: true,
                equalTo: '#newPwd',
                minlength: 6,
                maxlength: 20
            },
        };

    <?php } ?>
    $("#change_password_form").validate({
        rules: loginRules,
        messages: {
            currentPwd: {
                required: "<?php echo trans('validation.currentpasswordrequiredfield'); ?>"
            },
            password: {
                required: "<?php echo trans('validation.passwordrequiredfield'); ?>"
            },
            confirm_password: {
                required: "<?php echo trans('validation.confirmpasswordrequiredfield'); ?>",
                equalTo: "<?php echo trans('validation.passwordnotmatch'); ?>"
            },
        }
    });
    //enter only character in textbox
    $('.alphaonly').bind('keyup blur', function () {
        var node = $(this);
        node.val(node.val().replace(/[^a-z ^A-Z]/g, ''));
    }
    );

    $('.alphaonly_username').bind('keyup blur', function () {
        var node = $(this);
        node.val(node.val().replace(/[^a-z ^A-Z ^0-9 ^_]/g, ''));
    }
    );

    function readURL2(input_file) {
        if (input_file.files && input_file.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var fileType = input_file.files[0];
                $("#profile_setting_form_submit").removeAttr('disabled');

                if (fileType.type == 'image/jpeg' || fileType.type == 'image/jpg' || fileType.type == 'image/png' || fileType.type == 'image/bmp')
                {
                    if (input_file.files[0].size > 6000000) {
                        $("#err").text("<?php echo trans('label.filesizetohign'); ?>");
                        $("#profile_setting_form_submit").attr('disabled', 'disabled');
                        $("#profile_url").val('');
                    } else {
                        $("#err").text(fileType.name);
                    }
                } else {
                    $("#err").text("<?php echo trans('label.filesizetohign'); ?>");
                    $("#profile_setting_form_submit").attr('disabled', 'disabled');
                    $("#profile_url").val('');
                }
                $('#profile_url').attr('src', e.target.result);
            };

            reader.readAsDataURL(input_file.files[0]);
        }
    }

    $("#profile_setting_form_submit").click(function () {
        var form = $("#profile_setting_form");
        form.validate();
        if (form.valid()) {
            form.submit();
            $("#profile_setting_form_submit").attr("disabled", 'disabled');
        } else {
            $("#profile_setting_form_submit").removeAttr("disabled", 'disabled');
        }
        return true;
    });

    $("#change_password_form_submit").click(function () {
        var form = $("#change_password_form");
        form.validate();
        if (form.valid()) {
            form.submit();
            $("#change_password_form_submit").attr("disabled", 'disabled');
        } else {
            $("#change_password_form_submit").removeAttr("disabled", 'disabled');
        }
        return true;
    });

</script>
@endsection
