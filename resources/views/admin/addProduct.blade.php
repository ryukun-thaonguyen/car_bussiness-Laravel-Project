<div class="card">
    <div style="margin: 30px">
    <label style="color: red"> Add Product </label>
    <form action="" method="POST">
        @csrf
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="">Product's name</label>
                @if (session('name'))
                <input type="text" required  value="{{ session('name') }}" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
                @else
                <input type="text" required  value="" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
                @endif

             </div>
             <div class="form-group">
                <label for="">Price($)</label>
                @if (session('price'))
                <input type="number" required value="{{ session('price') }}" class="form-control" name="price" id="price" aria-describedby="helpId" placeholder="">
                 @else
                <input type="number" required value="" class="form-control" name="price" id="price" aria-describedby="helpId" placeholder="">
                @endif
              </div>
              <div class="form-group">
                <label for="">Mileage</label>
                @if (session('mileage'))
                <input type="number" required value="{{ session("mileage") }}" class="form-control" name="mileage" id="mileage" aria-describedby="helpId" placeholder="">
                 @else
                 <input type="number" required value="" class="form-control" name="mileage" id="mileage" aria-describedby="helpId" placeholder="">
                @endif

            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="type">Type</label>
                @if (session('brand'))
                <select id="type" class="custom-select"  name="type">
                    @if (session("brand")=="car")
                    <option value="car">Car</option>
                    <option value="moto">Moto</option>
                    @else
                    <option value="moto">Moto</option>
                    <option value="car">Car</option>
                    @endif

                </select>
                 @else
                 <select id="type" class="custom-select"  name="type">
                    <option value="car">Car</option>
                    <option value="moto">Moto</option>
                </select>
                @endif

            </div>
            <div class="form-group">
                <label for="">Brand</label>
                @if (session('brand'))
                <input type="text" required value="{{ session("brand") }}" class="form-control" name="brand" id="brand" aria-describedby="helpId" placeholder="">
                 @else
                 <input type="text" required value="" class="form-control" name="brand" id="brand" aria-describedby="helpId" placeholder="">
                @endif
            </div>
            <div class="form-group">
                <label for="">Year</label>
                @if (session('year'))
                <input type="number" required value="{{ session("year") }}" class="form-control" name="year" id="year" aria-describedby="helpId" placeholder="">
                 @else
                 <input type="number" required value="" class="form-control" name="year" id="year" aria-describedby="helpId" placeholder="">
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label for="slug">Slug</label>

                  <button type="button" style="float: right" id="clickGetSlug" class="btn btn-success">Get Suggestion</button>
                  @if (session('slug'))
                  <input type="text" required class="form-control" value="{{ session('slug') }}" name="slug" id="slug" aria-describedby="helpId" placeholder="">
                   @else
                   <input type="text" required class="form-control" name="slug" id="slug" aria-describedby="helpId" placeholder="">
                  @endif
                  <small id="noNameNoti" style="display: none" class="text-danger">Enter product's name to get the suggestion</small>
                </div>
        </div>
        <div class="form-group" style="float: left">
            <div class="input-group">
                <div class="custom-file" >
                <input type="file" hidden name="uploadImage"  id="uploadImage" value="" class="custom-file-input" >
                <input type="number" hidden id="quantityImg" value="0">
                <input type="text" name="image" id="image" value="[]" hidden>
                <label style="float: left" class="input-group-text btn-success" type="button" for="uploadImage">Add Image</i></label>
                </div>
            </div>
        </div>
      </div>
      <div class="row" id="preImg">
     </div>
    <button type="submit" style="float: right" class="btn btn-primary">Add</button>
    </form>
</div>

<form action="/admin/product/add/getSlug" method="post">
    @csrf
    <input type="text" hidden id="getName" name="name" >
    <input type="text" hidden id="getBrand" name="brand">
    <input type="text" hidden id="getMileage" name="mileage">
    <input type="text" hidden id="getType" name="type">
    <input type="text" hidden id="getPrice" name="price">
    <input type="text" hidden id="getYear" name="year">
    <input class="form-control" type="submit" name="slug" type="text" id="getSlug" value="">
</form>
</div>

<script>

    document.getElementById("clickGetSlug").onclick=function(){
        if(document.getElementById("name").value==""){
            document.getElementById("noNameNoti").style.display="block";
        }else{
        var slug=document.getElementById("getSlug");
        document.getElementById("getName").value=document.getElementById("name").value;
        document.getElementById("getBrand").value=document.getElementById("brand").value;
        document.getElementById("getMileage").value=document.getElementById("mileage").value;
        document.getElementById("getType").value=document.getElementById("type").value;
        document.getElementById("getPrice").value=document.getElementById("price").value;
        document.getElementById("getYear").value=document.getElementById("year").value;
        slug.click();
        }
    }
</script>
