<div class="card">
    <div style="margin: 30px">
    <label style="color: red"> Edit Product {{ $product[0]->name }}</label>
    @if (session('notification'))
    <div style="text-align: center" class="alert alert-success">
        {{ session('notification') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="update" method="POST">
        @csrf
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <input type="text" name="idUpdate" id="idUpdate" hidden value="{{ $product[0]->id }}">
            <div class="form-group">
                <label for="">Product's name</label>
                <input type="text" required  value="{{ $product[0]->name }}" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
             </div>
             <div class="form-group">
                <label for="">Price($)</label>
                <input type="number" required value="{{ $product[0]->price }}" class="form-control" name="price" id="price" aria-describedby="helpId" placeholder="">
              </div>
              <div class="form-group">
                <label for="">Mileage</label>
                <input type="number" required value="{{ $product[0]->mileage }}" class="form-control" name="mileage" id="mileage" aria-describedby="helpId" placeholder="">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="my-select">Type</label>
                <select id="my-select" class="custom-select"  name="type">
                    @if($product[0]->type=='car')
                    <option value="car">Car</option>
                    <option value="moto">Moto</option>
                    @else
                    <option value="moto">Moto</option>
                    <option value="car">Car</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="">Brand</label>
                <input type="text" required value="{{ $product[0]->brand }}" class="form-control" name="brand" id="brand" aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Year</label>
                <input type="number" required value="{{ $product[0]->year }}" class="form-control" name="year" id="year" aria-describedby="helpId" placeholder="">
            </div>
            <label for="">Images</label>
            <div class="input-group">
                <div class="custom-file" >
                <input type="file" name="uploadImageEdit" onchange="" id="uploadImageEdit" value="" class="custom-file-input" >
                <input type="number" hidden id="quantityImgEdit" value="{{ count(json_decode($product[0]->image)) }}">
                <input type="text" name="imageEdit" id="imageEdit" value="[]" hidden>
                <label class="input-group-text" type="button" for="uploadImageEdit">Add Image</label>
                </div>
            </div>
        </div>
      </div>
      <div class="row" id="preImgEdit">
        @foreach ( json_decode($product[0]->image)  as $key => $img)
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" id="{{ $key }}">
           <div class="card">
               <img class="card-img-top" src="../../../{{ $img }}" alt="">
               <label style="text-align: center"><i onclick="removeImgEdit({{ $key }})" class="fas fa-trash text-danger"></i></label>
           </div>
        </div>
        @endforeach
    </div>
    <button type="submit" style="float: right" class="btn btn-primary">Update</button>
    </form>
</div>
</div>
