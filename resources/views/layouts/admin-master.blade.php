<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" name="viewport">
        <link rel="canonical" href="{{Request::url()}}" />
        <title>{{trans('label.title')}}</title>
        <meta name="keywords" content="{{trans('label.keywords')}}" />
        <meta name="description" content="{{trans('label.description')}}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
  
        <link rel="stylesheet" href="{{asset('css/admin/dist/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/admin/plugins/iCheck/square/blue.css')}}">
        <link rel="stylesheet" href="{{asset('css/admin/dist/css/skins/_all-skins.min.css')}}">
        <link rel="stylesheet" href="{{ asset('css/admin/chosen.css')}}">
        <link rel="stylesheet" href="{{asset('css/admin/custom.css')}}">
        @yield('header')
    </head>
    <body class="hold-transition skin-yellow sidebar-mini">
        <div class="wrapper">
            @include('layouts/admin-header')

            @include('layouts/admin-left-navigation')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="body_content">
                  @if (count($errors) > 0)
                  <div class="alert alert-danger danger">
                      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                          @foreach ($errors->all() as $error)
                            {{ $error }}<br/>
                          @endforeach
                  </div>
                  @endif
                  @if($message = Session::get('error'))
                  <div class="alert alert-danger danger">
                      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        {{ $message }}
                  </div>
                  @endif
                  @if($message = Session::get('success'))
                  <div class="alert alert-success success">
                      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        {{ $message }}
                  </div>
                  @endif
                </div>
                @yield('content')
            </div>

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.1
                </div>
                <strong>{{ucfirst(trans('label.copyright'))}}</strong>
            </footer>
            
            @include('layouts/admin-right-sidebar')
            
            <div class="control-sidebar-bg"></div>
        </div>
        <script src="{{asset('css/admin/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
        <script src="{{asset('css/admin/bootstrap/js/bootstrap.min.js')}}"></script>
        <!-- <script src="{{asset('css/admin/plugins/iCheck/icheck.min.js')}}"></script> -->
        <script src="{{asset('css/admin/plugins/fastclick/fastclick.js')}}"></script>
        <script src="{{asset('css/admin/dist/js/app.min.js')}}"></script>
        
        <!-- DataTables -->
        <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>

        <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>

        
        <script src="{{asset('css/admin/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('css/admin/plugins/chartjs/Chart.min.js')}}"></script>
        <script src="{{asset('css/admin/dist/js/demo.js')}}"></script>
        <script src="{{ asset('js/admin/chosen.jquery.js')}}"></script>
        <script src="{{asset('js/front/jquery.validate.min.js')}}"></script>
        
        @yield('script')
        <script>
          // $(function () {
          //   $('input').iCheck({
          //     checkboxClass: 'icheckbox_square-blue',
          //     radioClass: 'iradio_square-blue',
          //     increaseArea: '20%'
          //   });
          // });
          $(".is_number").on('keyup', function(){ this.value = this.value.replace(/[^0-9]/gi, '');});   
        </script>
    </body>
</html>

