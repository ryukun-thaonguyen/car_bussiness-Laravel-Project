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
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
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
                @include('admin.editProduct')
              @else
                    @if($option=="add")
                    @include('admin.addProduct')
                    @else <!--else of check option-->
                    @include('admin.listProduct')
                    @endif
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
<script type="text/javascript">
    $(function () {
        $("#uploadImage").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
                document.getElementById('quantityImg').value=Number(document.getElementById('quantityImg').value)+1;
                console.log('img: '+document.getElementById('quantityImg').value);
            }
        });
    });
    function imageIsLoaded(e) {
        var div=document.createElement('div');
        div.id=document.getElementById('quantityImg').value;
        div.className='col-xs-6 col-sm-6 col-md-6 col-lg-6';
        var card=document.createElement('div');
        card.className='card';
        var img=document.createElement('img');
        img.className='card-img-top';
        img.src=e.target.result;
        var label=document.createElement('label');
        label.style='text-align: center';
        label.innerHTML='<i  onclick ="remove('+div.id+')" class="fas fa-trash text-danger">';
        card.appendChild(img);card.appendChild(label);div.appendChild(card);
        $('#preImg').append(div);
        listImg=JSON.parse(document.getElementById('image').value);
        listImg.push(e.target.result);
        document.getElementById('image').value=JSON.stringify(listImg);
        // console.log(listImg);
    };
    function remove(id){
        listImg=JSON.parse(document.getElementById('image').value);
        listImg.splice(Number(id)-1,1);
        document.getElementById('image').value=JSON.stringify(listImg);
        // console.log('remove '+id);
        document.getElementById('preImg').removeChild(document.getElementById(id));
        // console.log(listImg);
    }

    //img edit
    $(function(){
        $("#uploadImageEdit").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoadedEdit;
                reader.readAsDataURL(this.files[0]);
                document.getElementById('quantityImgEdit').value=Number(document.getElementById('quantityImgEdit').value)+1;
                console.log('img: '+document.getElementById('quantityImgEdit').value);

            }
        });
    });
    function imageIsLoadedEdit(e) {
        var div=document.createElement('div');
        div.id=document.getElementById('quantityImgEdit').value;
        div.className='col-xs-3 col-sm-3 col-md-3 col-lg-3';
        var card=document.createElement('div');
        card.className='card';
        var img=document.createElement('img');
        img.className='card-img-top';
        img.src=e.target.result;
        var label=document.createElement('label');
        label.style='text-align: center';
        label.innerHTML='<i  onclick ="removeImgEdit('+div.id+')" class="fas fa-trash text-danger">';
        card.appendChild(img);card.appendChild(label);div.appendChild(card);
        $('#preImgEdit').append(div);
        listImg=JSON.parse(document.getElementById('imageEdit').value);
        listImg.push(e.target.result);
        document.getElementById('imageEdit').value=JSON.stringify(listImg);
        // console.log(listImg);
    };
    function removeImgEdit(id){
        listImg=JSON.parse(document.getElementById('imageEdit').value);
        listImg.splice(Number(id)-1,1);
        document.getElementById('imageEdit').value=JSON.stringify(listImg);
        console.log(listImg);
        document.getElementById('preImgEdit').removeChild(document.getElementById(id));
    }


 </script>
</body>
</html>
