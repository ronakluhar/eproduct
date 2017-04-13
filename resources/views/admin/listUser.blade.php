@extends('layouts.admin-master')
@section('content')
    <section class="content-header">
      <h1>
        {{trans('admin.usermanagement')}}
        <small>{{trans('admin.user')}}</small>
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <div class="box-header pull-right ">
                <i class="s_active fa fa-square"></i> {{trans('admin.activelbl')}} <i class="s_inactive fa fa-square"></i> {{trans('admin.inactivelbl')}}
            </div>
        </div>
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{trans('admin.userlist')}}</h3>
            </div>
            <div class="box-body">
              <table id="listUser" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>{{trans('admin.usertblheadname')}}</th>
                  <th>{{trans('admin.usertblheademail')}}</th>
                  <th>{{trans('admin.usertblheadphone')}}</th>
                  <th>{{trans('admin.usertblheadgender')}}</th>
                  <th>{{trans('admin.blheadstatus')}}</th>
                  <th>{{trans('admin.tblheadactions')}}</th>
                </tr>
                </thead>
                <tbody>
                     @forelse($users as $user)
                        <tr>
                            <td>
                                {{ucfirst($user->first_name)}} {{ucfirst($user->last_name)}}
                            </td>
                            <td>
                                {{ $user->email or "------" }}
                            </td>
                            <td>
                                {{$user->phone or "------"}}
                            </td>
                            <td>
                                @if ($user->gender == 1)
                                    {{trans('admin.lblmale')}}
                                @elseif($user->gender == 2)
                                    {{trans('admin.lblfemale')}}
                                @endif
                            </td>
                            <td>
                                @if ($user->deleted == 1)
                                    <i class="s_active fa fa-square"></i>
                                @elseif($user->deleted == 2)
                                    <i class="s_inactive fa fa-square"></i>
                                @else
                                    <i class="s_deleted fa fa-square"></i>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('/admin/edituser') }}/{{$user->id}}"><i class="fa fa-edit"></i> &nbsp;&nbsp;</a>
                                <a onclick="return confirm('<?php echo trans('admin.confirmdelete'); ?>')" href="{{ url('/admin/deleteuser') }}/{{$user->id}}"><i class="i_delete fa fa-trash"></i>&nbsp;&nbsp;</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4"><center>{{trans('admin.norecordfound')}}</center></td>
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
    $("#listUser").DataTable();
  });
</script>
@endsection