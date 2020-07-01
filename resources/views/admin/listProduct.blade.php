<div class="card">
    <div class="card-header">
      <a href="/admin/product/add" type="button" style="float:right" class="btn btn-primary" >
              <i class="fas fa-plus-circle"></i>
              add product
      </a>
    </div>

    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Name</th>
          <th>Type</th>
          <th>Price</th>
          <th>Brand</th>
          <th>Year</th>
          <th>Milieage</th>
          <th>Price</th>
          <th>Rate</th>
          <th>Created at</th>
          <th>Option</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($product as $p)
            <tr>
               <td>{{ $p->name }}</td>
               <td>{{ $p->type }}</td>
               <td>{{ $p->price }}</td>
               <td>{{ $p->brand }}</td>
               <td>{{ $p->year }}</td>
               <td>{{ number_format($p->mileage) }}</td>
               <td>{{ number_format($p->price) }}$</td>
               <td>{{ $p->rate }}</td>
               <td>{{ $p->created_at }}</td>
               <td>
                  <a class="btn btn-info btn-sm"  href="../admin/product/edit/{{ $p->id }}">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Edit
                  </a>
                  <a class="btn btn-danger btn-sm" href="../admin/product/edit/{{ $p->id }}/delete">
                          <i class="fas fa-trash"></i>
                          Delete
                  </a>
               </td>
              </tr>
            @endforeach
        </tbody>
        <tfoot>
              <tr>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Price</th>
                  <th>Brand</th>
                  <th>Year</th>
                  <th>Milieage</th>
                  <th>Price</th>
                  <th>Rate</th>
                  <th>Created at</th>
                  <th>Option</th>
              </tr>
        </tfoot>
      </table>
    </div>
  </div>
