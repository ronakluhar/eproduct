@extends('layouts.admin-master')
@section('content')

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{trans('admin.lbl_upload_logo')}}
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
                     <h3 class="box-title">{{trans('admin.lbl_upload_logo')}}</h3>
                </div><!-- /.box-header -->
                
                <form id="add_school_logo" class="form-horizontal" method="post" action="{{ url('/admin/upload-school-logo') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="school_logo" class="col-sm-2 control-label">{{trans('admin.select_image_file')}}</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="school_logo[]" multiple="multiple">
                            </div>
                        </div>                       
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{ url('admin/list-school-logo') }}">{{trans('admin.cancelbtn')}}</a>
                        <button type="submit" class="btn btn-info">{{trans('admin.upload')}}</button>
                    </div><!-- /.box-footer -->
                </form>
            </div>   <!-- /.row -->
        </div>
    </div>
</section><!-- /.content -->

@stop

@section('script')
<script type="text/javascript">
</script>
@stop

