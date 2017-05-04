@extends('layouts.admin-master')
@section('content')
    <section class="content-header">
      <h1>
          <div class="col-md-11">
                School Images              
          </div>
        <div class="col-md-1 col-sm-12 col-xs-6 mobo_btn">
            <a href="{{url('admin/upload-school-logo')}}" class="btn btn-success add-btn-primary pull-right">Add School Images</a>
        </div>
      </h1>          
    </section>
<div class="row">&nbsp;</div>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
<!--            <div class="box-header pull-right">
                <i class="s_active fa fa-square"></i> {{trans('admin.activelbl')}} <i class="s_inactive fa fa-square"></i> {{trans('admin.inactivelbl')}}
            </div>-->
        </div>
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> School Images </h3>
            </div>
            <div class="box-body">
              <table id="list_school_logo" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>UnitID</th>
                        <th>School Name</th>
                        <th>Logo</th>
                        <th>Main Image</th>
                        <th>Seal Image</th>
                        <th>Action</th>
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
        $('#list_school_logo').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "{{ url('admin/school-logo-list-ajax.json') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "language": {
                "emptyTable": "School logo data not available."
            },
            "columns": [
                { "name": "UnitID", "data": "UnitID" },
                { "name": "Institution_Name", "data": "Institution_Name" },
                { "name": "logo_image","data": "logo_image", "orderable": false },
                { "name": "main_image", "data": "main_image", "orderable": false },
                { "name": "seal_image", "data": "seal_image", "orderable": false },
                { "name": "action", "data": "action", "orderable": false }
            ],
            "order": [_order] // set column as a default sort by asc
        });
        $(document).on('click', '.i_delete', function(){
            if (confirm('Are you sure! you want to delete this record?')) {
                return true;
            }
            return false;
        });
    });
</script>
@endsection