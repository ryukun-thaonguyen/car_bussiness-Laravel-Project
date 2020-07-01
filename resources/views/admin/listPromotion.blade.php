<div class="card">
    @if (session('notification'))
    <div style="text-align: center" class="alert alert-success">
        {{ session('notification') }}
    </div
  @endif
    <div class="card-header">
      <a href="/admin/promote/add" type="button" style="float:right" class="btn btn-primary" >
              <i class="fas fa-plus-circle"></i>
              add promotion
      </a>
    </div>

    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Name</th>
          <th>Discount</th>
          <th>Limit using</th>
          <th>Number of users that can be used</th>
          <th>Create at </th>
          <th>Option</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($promotion as $p)
            <tr>
               <td>{{ $p->name }}</td>
               <td>{{ $p->discount }}%</td>
               <td>{{ $p->limited }}</td>
               <td>{{ count($p->users) }}</td>
               <td>{{ $p->created_at }}</td>
               <td>
                  <a class="btn btn-info btn-sm"  href="/admin/promote/edit/{{ $p->id }}">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Edit
                  </a>
                  <a class="btn btn-danger btn-sm" href="/admin/promote/edit/{{ $p->id }}/delete">
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
                <th>Discount</th>
                <th>Limit using</th>
                <th>Number of users that can be used</th>
                <th>Create at </th>
                <th>Option</th>
              </tr>
        </tfoot>
      </table>
    </div>
  </div>
