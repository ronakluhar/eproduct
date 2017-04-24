@extends('layouts.admin-master')
@section('content')

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{trans('admin.lbl_school_study_abroad')}}
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
                     <h3 class="box-title">{{trans('admin.lbl_school_study_abroad')}}</h3>
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

                <form id="add_school_study_abroad" class="form-horizontal" method="post" action="{{ url('/admin/save-school-study-abroad') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="school_study_abroad" class="col-sm-2 control-label">{{trans('admin.select_csv_file')}}</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="school_study_abroad" name="school_study_abroad">
                            </div>
                        </div>                       
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{ url('admin/list-school') }}">{{trans('admin.cancelbtn')}}</a>
                        <button type="submit" class="btn btn-info">{{trans('admin.import')}}</button>
                    </div><!-- /.box-footer -->
                </form>
            </div>   <!-- /.row -->
        </div>
    </div>
</section><!-- /.content -->

@stop

@section('script')
<script src="{{ asset('js/front/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
      var fileRules = {
          school_study_abroad : {
            required : true,           
          }
      };
      $("#add_school_study_abroad").validate({
          rules: fileRules,
          messages: {
              school_study_abroad: {
                  required: "Please upload valid csv file",                  
              },
          }
      });
    });
</script>
@stop

