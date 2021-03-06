@extends('layouts.admin-master')
@section('content')

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Import School Completions&nbsp;&nbsp; 
        <small><a href="{{asset('uploads/sample/college-completions-sample.csv')}}" style="color:black;font-weight: bold;">(View Sample File)</a></small>    
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
                     <h3 class="box-title">Import School Completions</h3>
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

                <form id="add_school_completions_detail" class="form-horizontal" method="post" action="{{ url('/admin/saveSchoolCompletion') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="templatename" class="col-sm-2 control-label">Select CSV file</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="schoolCompletion" name="schoolCompletion">
                            </div>
                        </div>                       
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{ url('admin/school-list') }}">{{trans('admin.cancelbtn')}}</a>
                        <button type="submit" class="btn btn-info">Import</button>
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
          schoolCompletion : {
            required : true,           
          }
      };
      $("#add_school_completions_detail").validate({
          rules: fileRules,
          messages: {
              schoolCompletion: {
                  required: "Please upload valid csv file",                  
              },
          }
      });
    });
</script>
@stop

