@extends('layouts.admin-master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{trans('admin.emailtemplatemanagement')}}
        <small>{{trans('admin.emailtemplate')}}</small>
      </h1>     
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <div class="box-header pull-right ">
                <i class="s_active fa fa-square"></i> {{trans('admin.activelbl')}} <i class="s_inactive fa fa-square"></i>{{trans('admin.inactivelbl')}}
            </div>
        </div>
        <!-- right column -->
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{trans('admin.emailtemplatelist')}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="ListEmailTemplate" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{trans('admin.templateblheadname')}}</th>
                        <th>{{trans('admin.templateblheadpseudoname')}}</th>
                        <th>{{trans('admin.templateblheadsubject')}}</th>
                        <th>{{trans('admin.templateblheadstatus')}}</th>
                        <th>{{trans('admin.templateblheadaction')}}</th>
                    </tr>
                </thead>
                <tbody>
                     @forelse($templatesDetail as $templates)
                        <tr>
                            <td>
                                {{$templates->templatename}}
                            </td>
                            <td>
                                {{$templates->templatepseudoname}}
                            </td>
                            <td>
                                {{$templates->subject}}
                            </td>
                            <td>
                                @if ($templates->deleted == 1)
                                <i class="s_active fa fa-square"></i>
                                @else
                                    <i class="s_inactive fa fa-square"></i>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('/admin/edit-email-template') }}/{{$templates->id}}"><i class="fa fa-edit"></i> &nbsp;&nbsp;</a>
                                <a onclick="return confirm('<?php echo trans('label.confirmdelete'); ?>')" href="{{ url('/admin/delete-email-template') }}/{{$templates->id}}"><i class="i_delete fa fa-trash"></i>&nbsp;&nbsp;</a>
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
    $("#ListEmailTemplate").DataTable();
  });
</script>
@endsection