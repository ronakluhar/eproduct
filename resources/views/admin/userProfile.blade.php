@extends('layouts.admin-master')
@section('header')
<style>
    .tabView ul.tab {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Float the list items side by side */
    .tabView ul.tab li {float: left;}

    /* Style the links inside the list items */
    .tabView ul.tab li a {
        display: inline-block;
        color: black;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of links on hover */
    .tabView ul.tab li a:hover {
        background-color: #ccc;
    }

    /* Create an active/current tablink class */
    .tabView ul.tab li a:focus, .active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabView .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
</style>
@endsection
@section('content')
    <section class="content-header">
      <h1>
        {{trans('admin.set_user_profile_heading')}}
      </h1>     
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-warning">
            <div class="box-body tabView">
              <ul class="tab">
                <li><a href="javascript:void(0)" class="tablinks active" onclick="OpenTab(event, 'profile')" id="defaultOpen">{{trans('admin.personal_detail')}}</a></li>
                <li><a href="javascript:void(0)" class="tablinks" onclick="OpenTab(event, 'changePassword')">{{trans('admin.change_password')}}</a></li>
              </ul>
              <div id="profile" class="tabcontent">
                <div class="box-header with-border">
                  <h3 class="box-title">{{trans('label.edit')}} Profile</h3>
                </div>
                <form class="form-horizontal" id="save_profile" method="post" action="{{ url('/admin/user-profile') }}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box-body">
                      <?php
                          if (old('first_name'))
                              $first_name = old('first_name');
                          elseif ($userDetail)
                              $first_name = $userDetail->first_name;
                          else
                              $first_name = '';
                      ?>
                      <div class="form-group has-feedback {{ $errors->has('first_name') ? ' has-error' : '' }}">
                          <label for="firstname" class="col-sm-2 control-label">{{trans('label.formlblfirstname')}}*</label>
                          <div class="col-sm-6">
                            <input class="form-control" id="first_name" name="first_name" placeholder="{{trans('label.formlblfirstname')}}" type="text" value="{{ $first_name }}">
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                          </div>
                      </div>
                      <?php
                          if (old('last_name'))
                              $last_name = old('last_name');
                          elseif ($userDetail)
                              $last_name = $userDetail->last_name;
                          else
                              $last_name = '';
                      ?>
                      <div class="form-group has-feedback {{ $errors->has('last_name') ? ' has-error' : '' }}">
                          <label for="firstname" class="col-sm-2 control-label">{{trans('label.formlbllastname')}}*</label>
                          <div class="col-sm-6">
                            <input class="form-control" id="last_name" name="last_name" placeholder="{{trans('label.formlbllastname')}}" type="text" value="{{ $last_name }}">
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                          </div>
                      </div>
                      <?php
                          if (old('email'))
                              $email = old('email');
                          elseif ($userDetail)
                              $email = $userDetail->email;
                          else
                              $email = '';
                      ?>
                       <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="firstname" class="col-sm-2 control-label">{{trans('label.formlblemail')}}</label>
                          <div class="col-sm-6">
                            <input class="form-control" id="email" name="email" placeholder="{{trans('label.formlblemail')}}" type="text" value="{{ $email }}" readonly>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                          </div>
                      </div>
                      <?php
                        if (old('gender'))
                            $gender = old('gender');
                        elseif ($userDetail)
                            $gender = $userDetail->gender;
                        else
                            $gender = '1';
                      ?>
                      <div class="form-group">
                          <label for="gender" class="col-sm-2 control-label">{{trans('label.formlblgender')}}*</label>
                          <div class="col-sm-6">
                              <label class="radio-inline">
                                <input type="radio" name="gender" id="gender1" value="1" <?php if ($gender == "1") echo "checked='checked'"; ?>> {{trans('label.lblmale')}}
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="gender" id="gender2" value="2" <?php if ($gender == "2") echo "checked='checked'"; ?>> {{trans('label.lblfemale')}}
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="gender" id="gender3" value="3" <?php if ($gender == "3") echo "checked='checked'"; ?>> {{trans('admin.lblother')}}
                              </label><br/>
                              <span id="gender_error_msg"></span>
                          </div>
                      </div>
                    </div>
                    <div class="box-footer">
                      <a class="btn btn-default" href="{{ url('admin/dashboard') }}">{{trans('label.cancelbtn')}}</a>
                      <button type="submit" class="btn btn-info" id="save_profile_submit">{{trans('label.savebtn')}}</button>
                    </div>
                </form>    
              </div>
              <div id="changePassword" class="tabcontent">
                <div class="box-header with-border">
                  <h3 class="box-title">{{trans('label.changepassword')}} Profile</h3>
                </div>
                <form class="form-horizontal" id="change_password" method="post" action="{{ url('/admin/change-password') }}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box-body">
                      <?php
                          if (old('password'))
                              $password = old('password');
                          else
                              $password = '';
                      ?>
                      <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password" class="col-sm-2 control-label">{{trans('label.formlblpassword')}}*</label>
                          <div class="col-sm-6">
                            <input class="form-control" id="password" name="password" placeholder="{{trans('label.formlblpassword')}}" type="password" value="{{ $password }}">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                          </div>
                      </div>
                      <?php
                          if (old('new_password'))
                              $new_password = old('new_password');
                          else
                              $new_password = '';
                      ?>
                      <div class="form-group has-feedback {{ $errors->has('new_password') ? ' has-error' : '' }}">
                          <label for="new_password" class="col-sm-2 control-label">{{trans('label.formlblpasswordnew')}}*</label>
                          <div class="col-sm-6">
                            <input class="form-control" id="new_password" name="new_password" placeholder="{{trans('label.formlblpasswordnew')}}" type="password" value="{{ $new_password }}">
                            @if ($errors->has('new_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new_password') }}</strong>
                                </span>
                            @endif
                          </div>
                      </div>
                      <?php
                          if (old('new_password_confirm'))
                              $new_password_confirm = old('new_password_confirm');
                          else
                              $new_password_confirm = '';
                      ?>
                      <div class="form-group has-feedback {{ $errors->has('new_password_confirm') ? ' has-error' : '' }}">
                          <label for="new_password_confirm" class="col-sm-2 control-label">{{trans('label.formlblpasswordconfirm')}}*</label>
                          <div class="col-sm-6">
                            <input class="form-control" id="new_password_confirm" name="new_password_confirm" placeholder="{{trans('label.formlblpasswordconfirm')}}" type="password" value="{{ $new_password_confirm }}">
                            @if ($errors->has('new_password_confirm'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new_password_confirm') }}</strong>
                                </span>
                            @endif
                          </div>
                      </div>  
                    </div>
                    <div class="box-footer">
                      <a class="btn btn-default" href="{{ url('admin/dashboard') }}">{{trans('label.cancelbtn')}}</a>
                      <button type="submit" class="btn btn-info" id="change_password_submit">{{trans('label.savebtn')}}</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('script')
<script type="text/javascript">
  var validationRules = {
      first_name: {
          required: true,
          maxlength : 20,
          minlength : 2,
      },
      last_name: {
          required: true,
          maxlength : 20,
          minlength : 2,
      },
      gender: {
          required: true
      },
  };
  $("#save_profile").validate({
      rules: validationRules,
      messages: {
          first_name: {
              required: "<?php echo trans('validation.firstnamerequiredfield'); ?>",
              maxlength: "<?php echo trans('validation.firstnamemaxlength'); ?>",
              minlength: "<?php echo trans('validation.firstnameminlength'); ?>",
          },
          last_name: {
              required: "<?php echo trans('validation.lastnamerequiredfield'); ?>",
              maxlength: "<?php echo trans('validation.lastnamemaxlength'); ?>",
              minlength: "<?php echo trans('validation.lastnameminlength'); ?>",
          },
          gender: {
              required: "<?php echo trans('validation.genderquiredfield'); ?>"
          },
      },
      errorPlacement: function(error, element) {
          if (element.attr("name") == "gender") {
              error.appendTo("#gender_error_msg");
          } else {
              error.insertAfter(element)
          }
      }
  });
  $("#save_profile_submit").click(function(){
    var form = $("#save_profile");
    form.validate();
    if(form.valid())
    {
      form.submit();
      $("#save_profile_submit").attr("disabled", 'disabled');
    }
    else
    {
      $("#save_profile_submit").removeAttr("disabled", 'disabled');
    }
  });

  var passwordRules = {
      password: {
          required: true,
          minlength : 6,
          maxlength : 20,
      },
      new_password : {
          required: true, 
          minlength: 6,
          maxlength : 20,
      },
      new_password_confirm : {
          required: true, 
          minlength: 6, 
          maxlength : 20,
          equalTo: "#new_password"
      },
  };
  $("#change_password").validate({
      ignore: "",
      rules: passwordRules,
      messages: {
          password : {
              required: "<?php echo trans('passwords.required'); ?>",
              maxlength: "<?php echo trans('validation.passwordmaxlength'); ?>",
              minlength: "<?php echo trans('validation.passwordminlength'); ?>",
          },
          new_password: {
              required: "<?php echo trans('passwords.newpasswordrequired'); ?>",
              maxlength: "<?php echo trans('validation.passwordmaxlength'); ?>",
              minlength: "<?php echo trans('validation.passwordminlength'); ?>",
          },
          new_password_confirm: {
              required: "<?php echo trans('passwords.samepasswordrequired'); ?>",
              maxlength: "<?php echo trans('validation.passwordmaxlength'); ?>",
              minlength: "<?php echo trans('validation.passwordminlength'); ?>",
              equalTo : "<?php echo trans('validation.passwordequalto'); ?>",
          },
      },
  });
  $("#change_password_submit").click(function(){
    var form = $("#change_password");
    form.validate();
    if(form.valid())
    {
      form.submit();
      $("#change_password_submit").attr("disabled", 'disabled');
    }
    else
    {
      $("#change_password_submit").removeAttr("disabled", 'disabled');
    }
  });

  document.getElementById("defaultOpen").click();

  function OpenTab(evt, cityName) 
  {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
  }
</script>
@stop