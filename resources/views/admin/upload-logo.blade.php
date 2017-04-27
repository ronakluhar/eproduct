@extends('layouts.admin-master')
@section('content')

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @if(isset($logo_detail) && !empty($logo_detail) && isset($logo_detail->school)){{trans('admin.lbl_update_logo')}} @else {{trans('admin.lbl_upload_logo')}} @endif
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
                     <h3 class="box-title">
                         @if(isset($logo_detail) && !empty($logo_detail) && isset($logo_detail->school)){{trans('admin.lbl_update_logo')}} @else {{trans('admin.lbl_upload_logo')}} @endif
                     </h3>
                </div><!-- /.box-header -->
                
                <form id="add_school_logo" class="form-horizontal" method="post" action="{{ url('/admin/upload-school-logo') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="@if(isset($logo_detail) && !empty($logo_detail)){{ $logo_detail->school->UnitID }} @endif">

                    @if(isset($logo_detail) && !empty($logo_detail) && isset($logo_detail->school))
                    <div class="box-body">
                        <div class="form-group">
                            <label for="school_name" class="col-sm-2 control-label">{{trans('admin.school_name')}}</label>
                            <div class="col-sm-10">
                                <label for="school_name" class="control-label">{{ $logo_detail->school->Institution_Name }}</label>
                            </div>
                        </div>                       
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="school_image" class="col-sm-2 control-label">{{trans('admin.school_image')}}</label>
                            <div class="col-sm-10">
                                <img src="{{ public_path($logo_path.$logo_detail->image_path) }}" alt="{{ $logo_detail->image_path }}" height="100" width="100"/>
                            </div>
                        </div>                       
                    </div>
                    @endif
                    
                    <div class="box-body">
                        <div class="form-group">
                            <label for="school_logo" class="col-sm-2 control-label">{{trans('admin.select_image_file')}}</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="school_logo[]" @if(!isset($logo_detail)) multiple="multiple"  @endif>
                            </div>
                        </div>                       
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{ url('admin/list-school-logo') }}">{{trans('admin.cancelbtn')}}</a>
                        <button type="submit" class="btn btn-info">@if(isset($logo_detail) && !empty($logo_detail) && isset($logo_detail->school)) {{trans('admin.updatebtn')}} @else {{trans('admin.upload')}} @endif</button>
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

