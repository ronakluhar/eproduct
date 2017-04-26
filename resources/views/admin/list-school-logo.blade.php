@extends('layouts.admin-master')
@section('content')
    <section class="content-header">
      <h1>
        {{trans('admin.school_logo')}}
        <small>{{trans('admin.school')}}</small>
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <div class="box-header pull-right">
                <i class="s_active fa fa-square"></i> {{trans('admin.activelbl')}} <i class="s_inactive fa fa-square"></i> {{trans('admin.inactivelbl')}}
            </div>
        </div>
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> {{trans('admin.lbl_school_logo_list')}} </h3>
            </div>
            <div class="box-body">
              <table id="list_school_logo" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                <thead>
                <tr>
                  <th>UnitID</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                     @forelse($school_logo as $_school_logo)
                        <tr>
                            <td>{{$_school_logo->UnitID}}</td>
                            <td>{{ucfirst($_school_logo->Institution_Name)}}</td>
                            <td>
                                @if(file_exists(public_path($logo_path.$_school_logo->image_path)))
                                    <img src="{{ public_path($logo_path.$_school_logo->image_path) }}" alt="{{ $_school_logo->image_path }}"/>
                                @else
                                    {{ '----' }}
                                @endif
                            </td>
                            <td>
                                @if ($_school_logo->deleted == 1)
                                    <i class="s_active fa fa-square"></i>
                                @elseif($_school_logo->deleted == 2)
                                    <i class="s_inactive fa fa-square"></i>
                                @else
                                    <i class="s_deleted fa fa-square"></i>
                                @endif
                            </td>
                            <td>
                                <a onclick="return confirm('<?php echo trans('admin.confirmdelete'); ?>')" href="{{ url('/admin/delete-school-logo') }}/{{$_school_logo->UnitID}}"><i class="i_delete fa fa-trash"></i>&nbsp;&nbsp;</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5"><center>{{trans('admin.norecordfound')}}</center></td>
                        </tr>
                        @endforelse
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<!-- /.content-wrapper -->
@endsection
@section('script')

<script>
  $(function () {
    $("#list_school_logo").DataTable();
  });
</script>
@endsection