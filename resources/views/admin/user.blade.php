<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin| product</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/datatables-responsive/css/responsive.bootstrap4.min.css">
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
            <h1>Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">order</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <div class="modal" id="addProductModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="product/add" method="post">
                    @csrf
                <div class="modal-header">
                  <h4 class="modal-title">Add product</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="container">
                      <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="">Product's name</label>
                                <input type="text" required class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
                             </div>
                             <div class="form-group">
                                <label for="">Price($)</label>
                                <input type="number" required class="form-control" name="price" id="price" aria-describedby="helpId" placeholder="">
                              </div>
                              <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input type="number" required class="form-control" name="quantity" id="quantity" aria-describedby="helpId" placeholder="">
                              </div>
                              <div class="form-group">
                                <label for="">Mileage</label>
                                <input type="number" required class="form-control" name="mileage" id="mileage" aria-describedby="helpId" placeholder="">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="my-select">Type</label>
                                <select id="my-select" class="custom-select" name="type">
                                    <option value="car">Car</option>
                                    <option value="moto">Moto</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Brand</label>
                                <input type="text" required class="form-control" name="brand" id="brand" aria-describedby="helpId" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">Year</label>
                                <input type="number" required class="form-control" name="year" id="year" aria-describedby="helpId" placeholder="">
                            </div>
                            <label for="">Images</label>
                            <div class="input-group">
                                <div class="custom-file" >
                                <input type="file" name="uploadImage"  id="uploadImage" value="" class="custom-file-input" >
                                <input type="number" hidden id="quantityImg" value="0">
                                <input type="text" name="image" id="image" value="[]" hidden>
                                <label class="input-group-text" type="button" for="uploadImage">Choose file</label>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="row" id="preImg">
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">add</button>
                </div>
                </form>
              </div>
            </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                {{-- <button type="button" style="float:right" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
                        <i class="fas fa-plus-circle"></i>
                        add product
                </button> --}}
              </div>

              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Full name</th>
                    <th>Gmail</th>
                    <th>Role</th>
                    <th>Option</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($users as $value)
                      <tr>
                           <td>{{ $value->email}}</td>
                           <td>{{ $value->fullname }}</td>
                           <td>{{ $value->role }}</td>
                           <td>
                               <a name="" id="" class="btn btn-primary" href="#" role="button">View</a>
                           </td>
                      </tr>
                      @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Full name</th>
                        <th>Gmail</th>
                        <th>Role</th>
                        <th>Option</th>
                      </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            {{-- @endif --}}
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
  });
</script>
</body>
</html>
