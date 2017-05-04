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
    $(document).ready(function () {
        var _order = [1, "asc"];
        $('#listSchool').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "{{ url('admin/school-list-ajax.json') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "language": {
                "emptyTable": "School data not available."
            },
            "columns": [
                { "name": "UnitID", "data": "UnitID" },
                { "name": "Institution_Name", "data": "Institution_Name" },
                { "name": "Institution_alias","data": "Institution_alias" },
                { "name": "Post_office_box", "data": "Post_office_box" },
                { "name": "City", "data": "City" },
                { "name": "State", "data": "State" },
                { "name": "ZIP_code", "data": "ZIP_code" },
                { "name": "Name_chief_administrator", "data": "Name_chief_administrator" },
                { "name": "Title_chief_administrator", "data": "Title_chief_administrator" },
                { "name": "General_information_number", "data": "General_information_number" },
                { "name": "Internet_web_address", "data": "Internet_web_address" },
                { "name": "County_name", "data": "County_name" }
            ],
            "order": [_order] // set column as a default sort by asc
        });
    });
</script>
@endsection