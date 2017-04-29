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
                    <input type="hidden" name="id" value="@if(isset($logo_detail) && !empty($logo_detail) && isset($logo_detail->school)){{ $logo_detail->school->UnitID }} @endif">
                    <input type="hidden" name="school_image" value="@if(isset($logo_detail) && !empty($logo_detail)){{$logo_detail->image_path}}@endif">
                    <div class="box-body">                      
                        <div class="form-group">
                            <label for="school_name" class="col-md-3">Select School</label>
                            <div class="col-md-9">
                                @if(!empty($schoolDatas))                                    
                                    <select id="school_id" name="school_id" class="form-control">
                                        @foreach($schoolDatas as $key=>$data)
                                            <option value="{{$data['UnitID']}}">{{$data['UnitID']}} - {{$data['Institution_Name']}}</option>
                                        @endforeach
                                    </select>                                                                            
                                @endif
                            </div>
                        </div>                       

                        <div class="form-group">
                            <label for="" class="col-md-3">Update school Logo</label>
                            <div class="col-md-3">
                                <input type="file" class="form-control" name="school_logo[]" @if(!isset($logo_detail)) multiple="multiple"  @endif>
                            </div>
                            <div class="col-md-3">
                                @if(isset($logo_detail) && !empty($logo_detail))
                                    <img src="{{ asset($logo_path.$logo_detail->image_path) }}" alt="{{ $logo_detail->image_path }}" height="70" width="70"/>
                                @endif
                            </div>
                        </div>               

                        <div class="form-group">
                            <label for="school_main_image" class="col-md-3">Update school Main Image</label>
                            <div class="col-md-3">
                                <input type="file" class="form-control" name="school_main_image[]" @if(!isset($logo_detail)) multiple="multiple"  @endif>
                            </div>
                            <div class="col-md-3">
                                @if(isset($logo_detail) && !empty($logo_detail))
                                    <img src="{{ asset($logo_path.$logo_detail->image_path) }}" alt="{{ $logo_detail->image_path }}" height="70" width="70"/>
                                @endif
                            </div>
                        </div>                       

                        <div class="form-group">
                            <label for="school_main_image" class="col-md-3">Update school Seal Image</label>
                            <div class="col-md-3">
                                <input type="file" class="form-control" name="school_main_image[]" @if(!isset($logo_detail)) multiple="multiple"  @endif>
                            </div>
                            <div class="col-md-3">
                                @if(isset($logo_detail) && !empty($logo_detail))
                                    <img src="{{ asset($logo_path.$logo_detail->image_path) }}" alt="{{ $logo_detail->image_path }}" height="70" width="70"/>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="school_main_image" class="col-md-3">Add Main Image Credit</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="school_main_image[]">
                            </div>
                            
                        </div>
                        
                    </div> 
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{ url('admin/list-school-logo') }}">{{trans('admin.cancelbtn')}}</a>
                        <button type="submit" class="btn btn-info">@if(isset($logo_detail) && !empty($logo_detail) && isset($logo_detail->school)) {{trans('admin.updatebtn')}} @else {{trans('admin.upload')}} @endif</button>
                    </div><!-- /.box-footer -->
                </form>

                <!-- /.row -->
            </div>
        </div>
    </div>
</section><!-- /.content -->

@stop

@section('script')
<script type="text/javascript">
</script>
@stop

