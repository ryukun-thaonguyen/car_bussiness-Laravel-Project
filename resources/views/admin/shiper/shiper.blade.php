<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KunCar | Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="../icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../css/adminlte.min.css">
  <link rel="stylesheet" href="../overlayScrollbars/css/OverlayScrollbars.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('admin.navbar')
    @include('admin.shiper.menubar')
    <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>All available orders</h1>
              </div>
            </div>
          </div>
        </section>
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                  @if ($option=="order")
                  @include('admin.shiper.list')
                  @elseif($option=="shipping")
                  @include('admin.shiper.shipping')
                  @elseif($option=="shipped")
                  @include('admin.shiper.shipped')
                  @endif

              </div>
            </div>
          </div>
        </section>
      </div>
  </div>

  <aside class="control-sidebar control-sidebar-dark">

  </aside>
</div>
<script src="../jquery/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

{{-- <script src="/sweetalert2/sweetalert2.min.js"></script> --}}
<script src="../datatables/jquery.dataTables.min.js"></script>
<script src="../datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../js/admin.min.js"></script>
<script src="../js/demo.js"></script>


<script type="text/javascript">
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
  });
</script>
</body>
</html>
