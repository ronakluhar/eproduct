@extends('layouts.admin-master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{trans('admin.usermanagement')}}
        <small>{{trans('admin.user')}}</small>
      </h1>     
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo (isset($userDetail) && !empty($userDetail)) ? trans('admin.edit') : trans('admin.create') ?> {{trans('admin.user')}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="createUser" method="post" action="{{ url('/admin/saveuser') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="<?php echo (isset($userDetail) && !empty($userDetail)) ? $userDetail->id : '0' ?>">
                <div class="box-body">
                    <?php
                        if (old('first_name'))
                            $first_name = old('first_name');
                        elseif ($userDetail)
                            $first_name = $userDetail->first_name;
                        else
                            $first_name = '';
                    ?>
                    <div class="form-group">
                        <label for="firstname" class="col-sm-2 control-label">{{trans('admin.formlblfirstname')}}</label>

                        <div class="col-sm-6">
                          <input class="form-control alphaonly" id="first_name" name="first_name" placeholder="{{trans('admin.formlblfirstname')}}" type="text" value="{{ $first_name }}">
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
                    <div class="form-group">
                        <label for="lastname" class="col-sm-2 control-label">{{trans('admin.formlbllastname')}}</label>

                        <div class="col-sm-6">
                          <input class="form-control alphaonly" id="last_name" name="last_name" placeholder="{{trans('admin.formlbllastname')}}" type="text" value = "{{ $last_name }}">
                        </div>
                    </div>
                    <?php
                        if (old('username'))
                            $username = old('username');
                        elseif ($userDetail)
                            $username = $userDetail->username;
                        else
                            $username = '';
                    ?>
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">{{trans('admin.formlblusername')}}</label>

                        <div class="col-sm-6">
                          <input class="form-control alphaonly_username" id="username" name="username" placeholder="{{trans('admin.formlblusername')}}" type="text" value="{{ $username }}">
                        </div>
                    </div>
                    <?php
                        if (old('phone'))
                            $phone = old('phone');
                        elseif ($userDetail)
                            $phone = $userDetail->phone;
                        else
                            $phone = '';
                    ?>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">{{trans('admin.usertblheadphone')}}</label>

                        <div class="col-sm-6">
                          <input class="form-control" id="phone" name="phone" placeholder="{{trans('admin.usertblheadphone')}}" type="text" value="{{ $phone }}" maxlength="12"/>
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
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">{{trans('admin.formlblemail')}}</label>

                        <div class="col-sm-6">
                            <input class="form-control" id="email" name="email" placeholder="{{trans('admin.formlblemail')}}" type="email" value="{{ $email }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">{{ (isset($userDetail->id)) ? trans('admin.changepassword') : trans('admin.formlblpassword') }}</label>

                        <div class="col-sm-6">
                          <input class="form-control" id="password" name="password" placeholder="{{trans('admin.formlblpassword')}}" type="password">
                        </div>
                    </div>
                    <?php
                        if (old('gender'))
                            $gender = old('gender');
                        elseif ($userDetail)
                            $gender = $userDetail->gender;
                        else
                            $gender = 1;
                    ?>
                    <div class="form-group">
                        <label for="gender" class="col-sm-2 control-label">{{trans('admin.formlblgender')}}</label>

                        <div class="col-sm-6">
                            <label class="radio-inline">
                              <input type="radio" name="gender" id="gender1" value="1" <?php if ($gender == '1') echo "checked='checked'"; ?>> {{trans('admin.lblmale')}}
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="gender" id="gender2" value="2" <?php if ($gender == '2') echo "checked='checked'"; ?>> {{trans('admin.lblfemale')}}
                            </label>
                            <br/>
                            <span id="gender_error_msg"></span>
                        </div>
                    </div>

                    <?php
                        if (old('deleted'))
                            $deleted = old('deleted');
                        elseif ($userDetail)
                            $deleted = $userDetail->deleted;
                        else
                            $deleted = 1;
                    ?>
                    <div class="form-group">
                        <label for="gender" class="col-sm-2 control-label">{{trans('admin.blheadstatus')}}</label>

                        <div class="col-sm-6">
                            <label class="radio-inline">
                              <input type="radio" name="deleted" id="deleted1" value="1" <?php if ($deleted == '1') echo "checked='checked'"; ?>> {{trans('admin.activelbl')}}
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="deleted" id="deleted2" value="2" <?php if ($deleted == '2') echo "checked='checked'"; ?>> {{trans('admin.inactivelbl')}}
                            </label>
                            <br/>
                            <span id="deleted_error_msg"></span>
                        </div>
                    </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a class="btn btn-default" href="{{ url('admin/list-user') }}">{{trans('admin.cancelbtn')}}</a>
                <button type="submit" class="btn btn-info">{{trans('admin.savebtn')}}</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<!-- /.content-wrapper -->
@endsection
@section('script')

<script type="text/javascript">
    <?php if (isset($userDetail->id) && $userDetail->id != '0') { ?>
          var validationRules = {
                      first_name: {
                          required: true,
                          minlength : 2,
                          maxlength : 20,
                      },
                      last_name: {
                          required: true,
                          minlength : 2,
                          maxlength : 20,
                      },
                      username: {
                          required: true,
                          minlength : 6,
                          maxlength : 20,
                      },
                      email: {
                          required: true,
                          email: true,
                          maxlength : 100,
                      },
                      gender: {
                          required: true
                      },
                      deleted: {
                          required: true
                      },
                  }
    <?php } else { ?>
            var validationRules = {
                first_name: {
                    required: true,
                    minlength : 2,
                    maxlength : 20,
                },
                last_name: {
                    required: true,
                    minlength : 2,
                    maxlength : 20,
                },
                username: {
                    required: true,
                    maxlength:20,
                    minlength : 6,
                },
                email: {
                    required: true,
                    email: true,
                    maxlength : 100,
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
                gender: {
                    required: true
                },
                deleted: {
                    required: true
                },
            }
    <?php } ?>

    $("#createUser").validate({
        rules: validationRules,
        messages: {
            first_name: {
                required: "<?php echo trans('validation.firstnamerequiredfield'); ?>"
            },
            last_name: {
                required: "<?php echo trans('validation.lastnamerequiredfield'); ?>"
            },
            username: {
                required: "<?php echo trans('validation.usernamerequiredfield') ?>"
            },
            email: {
                required: "<?php echo trans('validation.emailrequiredfield') ?>",
                email: "<?php echo trans('validation.validemailfield'); ?>"
            },
            password: {
                required: "<?php echo trans('validation.passwordrequiredfield'); ?>"
            },
            gender: {
                required: "<?php echo trans('validation.genderquiredfield'); ?>"
            },
            deleted: {
                required: "<?php echo trans('validation.statusfieldrequired'); ?>"
            },
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "gender") {
                error.appendTo("#gender_error_msg");
            } else {
                error.insertAfter(element)
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "deleted") {
                error.appendTo("#deleted_error_msg");
            } else {
                error.insertAfter(element)
            }
        }
    });

    $("#phone").on('keyup', function() {
        this.value = this.value.replace(/[^0-9]/gi, '');
    });

    $('.alphaonly').bind('keyup blur',function(){
        var node = $(this);
        node.val(node.val().replace(/[^a-z ^A-Z]/g,'') ); }
    );

    $('.alphaonly_username').bind('keyup blur',function(){
        var node = $(this);
        node.val(node.val().replace(/[^a-z ^A-Z ^0-9 ^_]/g,'') ); }
    );
    
</script>
@stop