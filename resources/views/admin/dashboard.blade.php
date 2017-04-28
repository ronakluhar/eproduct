@extends('layouts.admin-master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <h3>Dashboard</h3>
    </section>
@endsection

@section('script')
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('css/admin/dist/js/pages/dashboard2.js')}}"></script>

    <!-- /.content -->
@endsection