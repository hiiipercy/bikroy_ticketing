<!DOCTYPE html>
<html>
<head>
    @include('backend.includes.header')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    {{-- Toastr --}}
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    {{-- Datatable --}}
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.3/css/dataTables.responsive.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>

    .d-flex{
        display: flex !important;
    }
    .justify-content-between{
      justify-content: space-between;
    }
    .align-items-center{
      align-items: center;
    }
    .justify-content-center{
      justify-content: center;
    }
    .justify-content-end{
      justify-content: end;
    }
    .mr-2{
      margin-right: 2px;
    }
    .m-4{
      margin: 10px;
    }
    .border{
      size: 1px;
      color: #ECF0F5;
    }
    .my-0{
      margin-top: 0;
      margin-bottom: 0;
    }
    .mx-0{
      margin-left: 0;
      margin-right: 0;
    }
    .pt-3{
      padding-top: 10px;
    }
    .px-3{
      padding-left:10px; 
      padding-right:10px; 
    }
    .solid{
      border-style: solid;
    }
    .btn-hover{
      background-color: #D73925;
      color:#FFFFFF;
    }
    .red{
      color: red;
    }
    .infoo{
      margin-top: 10px;
      color: #FFFFFF;
      background: #367FA9;
      border-radius: 4px;
      padding: 2px
    }
    .mb-5{
      margin-bottom: 5px;
    }
    .mt-5{
      margin-top: 5px;
    }
    .my-5{
      margin-top: 5px;
      margin-bottom: 5px;
    }
    #swal2-title{
      font-size: 1.5em;
    }
    #swal2-html-container{
      font-size: 2em;
    }
    .swal2-confirm, .swal2-cancel{
      font-size: 1.2em;
    }
    .bg-primary{
      background: #367FA9;
    }
    .bg-warning{
      background: #E08E0B;
    }
    .bg-danger{
      background: #D73925;
    }

  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  @include('backend.includes.nav')
  <!-- =============================================== -->

  @include('backend.includes.sidebar')

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
        <main>
          <div class="container-fluid px-4">
              @yield('content')
          </div>
      </main>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('backend.includes.footer')
</div>


    

<script src="{{asset('backend/js/jquery.min.js')}}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  --}}
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('backend/js/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('backend/js/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
{{-- Datatable  --}}
  {{-- Datatables --}}
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/1.0.3/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
  <!-- include summernote css/js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
{{-- Toastr --}}
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2@11') }}"></script>

<!-- calender-->
<!--calender option -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


    <script src="{{asset('backend/js/demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
    
  })
</script>

<script>
  $(document).ready(function () {
    $('.summernote').summernote()
    
  })
   // toastr alert message
   function notification(status, message){
      toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": false,
          "progressBar": true,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "500",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
      }

      switch (status) {
          case 'success':
          toastr.success(message);
          break;

          case 'error':
          toastr.error(message);
          break;

          case 'warning':
          toastr.warning(message);
          break;

          case 'info':
          toastr.info(message);
          break;
      }
  }
    @if(session()->get('success'))
        notification('success',"{{ session()->get('success') }}")
    @elseif(session()->get('error'))
        notification('error',"{{ session()->get('error') }}")
    @elseif(session()->get('info'))
        notification('info',"{{ session()->get('info') }}")
    @elseif(session()->get('warning'))
        notification('warning',"{{ session()->get('warning') }}")
    @endif
</script>
@stack('js');

</body>
</html>
