<div class="card">
    <div class="card-header">
        @if (session('notification'))
        <div style="text-align: center" class="alert alert-success">
            {{ session('notification') }}
        </div>
        @endif
    </div>

    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Customer</th>
          <th>Product</th>
          <th>Promotion</th>
          <th>Price</th>
          <th>Date</th>
          <th>Status</th>
          <th>Option</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($orders as $o)
            <tr>
               <td>{{ $o->user->fullname }}</td>
               <td>
                   <ul>
                       @foreach ($o->products as $key=>$p)
                           <li>
                               <h6>{{ $p->name }}</h6>
                               <p>Type: {{ $p->type }}</p>
                               <p>Brand: {{ $p->brand }}</p>
                               <p>Mileage: {{ $p->mileage }}</p>
                               <p>Quantity: {{ $o->cart[$key]->quantity }} </p>
                               <p>Total Price: ${{ number_format($o->cart[$key]->quantity*$p->price) }} </p>
                           </li>
                       @endforeach
                   </ul>
               </td>
               <td>{{ $o->promote }}</td>
               <td>${{ number_format($o->totalPrice) }}</td>
               <td>{{ $o->created_at }}</td>
               <td>{{ $o->status }}</td>
               <td>
                  <a class="btn btn-info btn-sm"  href="../shipper/order/shiping/{{ $o->id }}">
                    <i class="fa fa-ship" aria-hidden="true"></i>
                          Shipping
                  </a>
                  <a class="btn btn-success btn-sm" href="../shipper/order/shipped/{{ $o->id }}">
                    <i class="fa fa-check" aria-hidden="true"></i>
                          Shiped
                  </a>
               </td>
              </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Customer</th>
                <th>Product</th>
                <th>Promotion</th>
                <th>Price</th>
                <th>Date</th>
                <th>Status</th>
                <th>Option</th>
              </tr>
        </tfoot>
      </table>
    </div>
  </div>
