@extends('layouts.admin-master')
@section('content')
    <section class="content-header">
      <h1>
        Schools Management
        <small>School</small>
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
              <h3 class="box-title">School List</h3>
            </div>
            <div class="box-body">
              <table id="listSchool" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                <thead>
                <tr>
                  <th>UnitID</th>
                  <th>Name</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Web Address</th>
                  <th>OPEID</th>
                  <th>Title IV Institution</th>
                  <th>Control</th>
                  <th>Level</th>
                  <th>Institution Category</th>
                  <th>Carnegie Classification</th>
                  <th>Award levels</th>
                  <th>Religious Affiliation</th>
                  <th>Calendar System</th>
                  <th>Reporting Method</th>
                  <th>Campus Setting</th>
                  <th>Distance Learning</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                     @forelse($schools as $school)
                        <tr>
                            <td>{{$school->UnitID}}</td>
                            <td>{{ucfirst($school->Institution_Name)}}</td>
                            <td>{{$school->City or "------" }}</td>
                            <td>{{$school->State or "------" }}</td>
                            <td>{{$school->Web_Address or "------" }}</td>
                            <td>{{$school->OPEID}}</td>
                            <td>{{$school->Title_IV_Institution}}</td>
                            <td>{{$school->Control}}</td>
                            <td>{{$school->Level}}</td>
                            <td>{{$school->Institution_Category}}</td>
                            <td>{{$school->Carnegie_Classification}}</td>
                            <td>{{$school->Award_levels}}</td>
                            <td>{{$school->Religious_Affiliation}}</td>
                            <td>{{$school->Calendar_System}}</td>
                            <td>{{$school->Reporting_Method}}</td>
                            <td>{{$school->Campus_Setting}}</td>
                            <td>{{$school->Distance_Learning}}</td>
                            <td>
                                @if ($school->deleted == 1)
                                    <i class="s_active fa fa-square"></i>
                                @elseif($school->deleted == 2)
                                    <i class="s_inactive fa fa-square"></i>
                                @else
                                    <i class="s_deleted fa fa-square"></i>
                                @endif
                            </td>
                            <td>
                                <a onclick="return confirm('<?php echo trans('admin.confirmdelete'); ?>')" href="{{ url('/admin/deleteuser') }}/{{$school->id}}"><i class="i_delete fa fa-trash"></i>&nbsp;&nbsp;</a>
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
    $("#listSchool").DataTable();
  });
</script>
@endsection