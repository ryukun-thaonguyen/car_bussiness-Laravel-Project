<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin| promotion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <link rel="stylesheet" href="/fontawesome-free/css/adminlte.min.css">

  {{-- <link rel="stylesheet" href="/toastr/toastr.min.css"> --}}
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('admin.navbar')
  @include('admin.menubar')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Product</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              @if($option=="edit")
                @include('admin.editPromotion')
              @elseif($option=="add")
                @include('admin.addPromotion')
              @else <!--else of check option-->
              @include('admin.listPromotion')
              @endif
          </div>
        </div>
      </div>
    </section>
  </div>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<script src="/jquery/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.bundle.min.js"></script>

{{-- <script src="/sweetalert2/sweetalert2.min.js"></script> --}}
<script src="/datatables/jquery.dataTables.min.js"></script>
<script src="/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<script src="/js/admin.min.js"></script>
<script src="/js/demo.js"></script>


<script type="text/javascript">
  /* The uploader form */
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('.duallistbox').bootstrapDualListbox()
  });





</script>

</body>
</html>
