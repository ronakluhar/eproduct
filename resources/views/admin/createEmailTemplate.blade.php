@extends('layouts.admin-master')
@section('content')

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{trans('admin.emailtemplates')}}
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
                     <h3 class="box-title"><?php echo (isset($templateDetail) && !empty($templateDetail)) ? trans('admin.edit') : trans('admin.create') ?> {{trans('admin.emailtemplate')}}</h3>
                </div><!-- /.box-header -->
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>{{trans('validation.whoops')}}</strong>{{trans('validation.someproblems')}}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form id="addEmailTemplate" class="form-horizontal" method="post" action="{{ url('/admin/save-email-template') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="<?php echo (isset($templateDetail) && !empty($templateDetail)) ? $templateDetail->id : '0' ?>">
                    <div class="box-body">

                        <?php
                        if (old('templatename'))
                            $templatename = old('templatename');
                        elseif ($templateDetail)
                            $templatename = $templateDetail->templatename;
                        else
                            $templatename = '';
                        ?>
                        <div class="form-group">
                            <label for="templatename" class="col-sm-2 control-label">{{trans('admin.formlblname')}}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="templatename" name="templatename" placeholder="{{trans('admin.formlblname')}}" value="{{$templatename}}" minlength="6" maxlength="50">
                            </div>
                        </div>

                        <?php
                        if (old('templatepseudoname'))
                            $templatepseudoname = old('templatepseudoname');
                        elseif ($templateDetail)
                            $templatepseudoname = $templateDetail->templatepseudoname;
                        else
                            $templatepseudoname = '';
                        ?>
                        <div class="form-group">
                            <label for="templatepseudoname" class="col-sm-2 control-label">{{trans('admin.formlblpseudoname')}}</label>
                            <div class="col-sm-10">
                                <input type="text" readonly="true" class="form-control" id="templatepseudoname" name="templatepseudoname" placeholder="{{trans('admin.formlblpseudoname')}}" value="{{$templatepseudoname}}" minlength="6" maxlength="50">
                            </div>
                        </div>

                        <?php
                        if (old('subject'))
                            $subject = old('subject');
                        elseif ($templateDetail)
                            $subject = $templateDetail->subject;
                        else
                            $subject = '';
                        ?>
                        <div class="form-group">
                            <label for="subject" class="col-sm-2 control-label">{{trans('admin.formlblsubject')}}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="{{trans('admin.formlblsubject')}}" value="{{$subject}}" minlength="6" maxlength="50">
                            </div>
                        </div>

                        <?php
                        if (old('body'))
                            $body = old('body');
                        elseif ($templateDetail)
                            $body = $templateDetail->body;
                        else
                            $body = '';
                        ?>
                        <div class="form-group">
                            <label for="body" class="col-sm-2 control-label">{{trans('admin.formlblbody')}}</label>
                            <div class="col-sm-10">
                                <textarea  name="body" id="body">{{$body}}</textarea>
                            </div>
                        </div>

                        <?php
                        if (old('deleted'))
                            $deleted = old('deleted');
                        elseif ($templateDetail)
                            $deleted = $templateDetail->deleted;
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
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{ url('admin/list-email-template') }}">{{trans('admin.cancelbtn')}}</a>
                        <button type="submit" class="btn btn-info">{{trans('admin.savebtn')}}</button>
                    </div><!-- /.box-footer -->
                </form>
            </div>   <!-- /.row -->
        </div>
    </div>
</section><!-- /.content -->

@stop

@section('script')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'body' );
    jQuery(document).ready(function() {

    jQuery.validator.addMethod("emptybody", function(value, element) {
    var et_body_data = CKEDITOR.instances['body'].getData();

  return et_body_data != '';
}, "<?php echo trans('validation.templatebobyrequiredfield')?>");

            var validationRules = {
                templatename : {
                    required : true
                },
                templatepseudoname : {
                    required : true
                },
                subject : {
                    required : true
                },
                body: {
                    emptybody : true
                },
                deleted : {
                    required : true
                }
            }

        $("#addEmailTemplate").validate({
            ignore : "",
            rules : validationRules,
            messages : {
                templatename : {
                    required : "<?php echo trans('validation.templatenamerequiredfield'); ?>"
                },
                templatepseudoname : {
                    required : "<?php echo trans('validation.templatepseudonamerequiredfield'); ?>"
                },
                subject : {
                    required : "<?php echo trans('validation.templatesubjectrequiredfield'); ?>"
                },
                body : {
                    emptybody : "<?php echo trans('validation.templatebobyrequiredfield'); ?>"
                },
                deleted : {
                    required : "<?php echo trans('validation.templatestatusrequiredfield'); ?>"
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "deleted") {
                    error.appendTo("#deleted_error_msg");
                } else {
                    error.insertAfter(element)
                }
            }
        })
    });
</script>
<?php if (empty($templateDetail)){ ?>
    <script>
    $('#templatename').keyup(function ()
    {
        var str = $(this).val();
        str = str.replace(/[^a-zA-Z0-9\s]/g, "");
        str = str.toLowerCase();
        str = str.replace(/\s/g, '-');
        $('#templatepseudoname').val(str);
    });
    </script>
    <?php } ?>
@stop

