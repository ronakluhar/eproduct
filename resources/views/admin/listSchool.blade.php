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
                  <th>Institution Alias</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Zip Code</th>
                  <th>Chief Administrator</th>
                  <th>Title of Administrator</th>
                  <th>General Info Number</th>
                  <th>Web Address</th>
                  <th>County Name</th>
                </tr>
                </thead>
                <tbody>
                     @forelse($schools as $school)
                        <tr>
                            <td>{{$school->UnitID}}</td>
                            <td>{{ucfirst($school->Institution_Name)}}</td>
                            <td>{{$school->Institution_alias or "------" }}</td>
                            <td>{{$school->Post_office_box or "------" }}</td>
                            <td>{{$school->City or "------" }}</td>
                            <td>{{$school->State or "------" }}</td>
                            <td>{{$school->ZIP_code or "------" }}</td>                            
                            <td>{{$school->Name_chief_administrator or "------" }}</td>                            
                            <td>{{$school->Title_chief_administrator or "------" }}</td>                            
                            <td>{{$school->General_information_number or "------" }}</td>                            
                            <td>{{$school->Internet_web_address or "------" }}</td>                            
                            <td>{{$school->County_name or "------" }}</td>                            
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