@extends('layouts.admin-master')
@section('content')

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @if(isset($school_image_detail) && !empty($school_image_detail)){{trans('admin.lbl_update_logo')}} @else {{trans('admin.lbl_upload_logo')}} @endif
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
                        @if(isset($school_image_detail) && !empty($school_image_detail)){{trans('admin.lbl_update_logo')}} @else {{trans('admin.lbl_upload_logo')}} @endif
                    </h3>
                </div><!-- /.box-header -->

                <form id="add_school_logo" class="form-horizontal" method="post" action="{{ url('/admin/upload-school-logo') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="@if(isset($school_image_detail) && !empty($school_image_detail)){{ $school_image_detail->UnitID }} @endif">
                    <div class="box-body">                      
                        <div class="form-group">
                            @if(isset($school_image_detail) && !empty($school_image_detail))
                            <label for="school_name" class="col-md-3">School Name</label>
                            <label class="col-md-9">{{ $school_image_detail->Institution_Name }}</label>
                            @else
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
                            
                            @endif
                        </div>                       

                        <div class="form-group">
                            <label for="school_logo" class="col-md-3">Update school Logo</label>
                            <div class="col-md-3">
                                <input type="file" class="form-control" name="school_logo">
                            </div>
                            <div class="col-md-3">
                                @if(isset($school_image_detail->school) && !empty($school_image_detail->school))
                                    @foreach($school_image_detail->school as $_school_images)
                                        @if($_school_images->image_type == Config::get('constant.LOGO_IMAGE_FLAG'))
                                        <img src="{{ asset($logo_path.$_school_images->image_path) }}" alt="{{ $_school_images->image_path }}" height="70" width="70"/>
                                        <?php $logo_image = $_school_images->image_path; ?>
                                        @endif
                                    @endforeach
                                    <input type="hidden" name="school_logo_image" value="@if(isset($logo_image) && !empty($logo_image)){{$logo_image}}@endif">
                                @endif
                            </div>
                        </div>               

                        <div class="form-group">
                            <label for="school_main_image" class="col-md-3">Update school Main Image</label>
                            <div class="col-md-3">
                                <input type="file" class="form-control" name="school_main_image">
                            </div>
                            <div class="col-md-3">
                                @if(isset($school_image_detail->school) && !empty($school_image_detail->school))
                                    @foreach($school_image_detail->school as $_school_images)
                                        @if($_school_images->image_type == Config::get('constant.MAIN_IMAGE_FLAG'))
                                        <img src="{{ asset($logo_path.$_school_images->image_path) }}" alt="{{ $_school_images->image_path }}" height="70" width="70"/>
                                        <?php $main_image = $_school_images->image_path; ?>
                                        @endif
                                    @endforeach
                                    <input type="hidden" name="school_main" value="@if(isset($main_image) && !empty($main_image)){{$main_image}}@endif">
                                @endif
                            </div>
                        </div>                       

                        <div class="form-group">
                            <label for="school_seal_image" class="col-md-3">Update school Seal Image</label>
                            <div class="col-md-3">
                                <input type="file" class="form-control" name="school_seal_image">
                            </div>
                            <div class="col-md-3">
                                @if(isset($school_image_detail->school) && !empty($school_image_detail->school))
                                    @foreach($school_image_detail->school as $_school_images)
                                        @if($_school_images->image_type == Config::get('constant.SEAL_IMAGE_FLAG'))
                                        <img src="{{ asset($logo_path.$_school_images->image_path) }}" alt="{{ $_school_images->image_path }}" height="70" width="70"/>
                                        <?php $seal_image = $_school_images->image_path; ?>
                                        @endif
                                    @endforeach
                                    <input type="hidden" name="school_seal" value="@if(isset($seal_image) && !empty($seal_image)){{$seal_image}}@endif">
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="school_credit_link" class="col-md-3">Add Main Image Credit</label>
                            @if(isset($school_image_detail->school) && !empty($school_image_detail->school))
                                @foreach($school_image_detail->school as $_school_images)
                                    @if($_school_images->image_type == Config::get('constant.MAIN_IMAGE_FLAG'))
                                    <?php $link = $_school_images->image_credit_link; ?>
                                    @endif
                                @endforeach
                            @endif
                            
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="school_credit_link" value="@if(isset($link) && !empty($link)){{$link}}@endif">
                            </div>
                            
                        </div>
                        
                    </div> 
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{ url('admin/list-school-logo') }}">{{trans('admin.cancelbtn')}}</a>
                        <button type="submit" class="btn btn-info">@if(isset($school_image_detail) && !empty($school_image_detail)) {{trans('admin.updatebtn')}} @else {{trans('admin.upload')}} @endif</button>
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

