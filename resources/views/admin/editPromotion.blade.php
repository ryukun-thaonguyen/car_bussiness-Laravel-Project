<div class="card">
    <div style="margin: 30px">
    <label style="color: red"> Add Promotion </label>
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
        <input type="text" name="id" hidden value="{{ $promote->id }}">
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">
                <label for="">Promotion's name</label>
                <input type="text" required  value="{{ $promote->name }}" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
             </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">
                <label for="">Discount(%)</label>
                <input type="number" min="1" max="100" required value="{{ $promote->discount }}" class="form-control" name="discount" id="discount" aria-describedby="helpId" placeholder="">
              </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">
                <label for="">Limited</label>
                <input type="number" min="1" max="100" required value="{{ $promote->limited }}" class="form-control" name="limited" id="limited" aria-describedby="helpId" placeholder="">
              </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Users available</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="">All users</label>
                        </div>
                        <div class="col-6">
                            <label for="">User can use</label>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple">
                                @foreach ($promote->users as $u)
                                <option selected value="{{ $u->id }}">{{ $u->email }}</option>
                                @endforeach
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}">{{ $u->email }}</option>
                                @endforeach
                            </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>
        </div>
      </div>
      <input type="text" hidden name="users" id="users">
    <button type="submit" id="add" style="float: right" class="btn btn-primary">Edit</button>
    </form>
</div>
</div>

<script>
    document.getElementById("add").onclick=function(){
        selected=[];
        var users=document.getElementById("bootstrap-duallistbox-selected-list_");
        for(var option of users.options){
            selected.push(option.value);
        }
        document.getElementById('users').value=JSON.stringify(selected);
    }

</script>
