<div class="card card-widget">
  <div class="card-header">
     <h5>Comment</h5>
     @if (!Auth::check())
     <a  href="/login" ><h6 style="color: rgb(111, 214, 245)">Login to Comment</h6></a>
 @endif
  </div>
  <div class="card-comments card-footer ">
      @foreach ($comments as $comment)
      <div class="card-comment">
        <!-- User image -->
        <img class="img-circle img-sm" src="../img/userIcon.png" alt="User Image">
        <div class="comment-text" style="font-size: 14px">
          <span class="username">
            {{ $comment->getUserName() }}
            <span class="text-muted float-right">{{ $comment->created_at }}</span>
          </span><!-- /.username -->
          {{ $comment->content }}
        </div>
          </div>
      @endforeach
  </div>
  <div class="card-footer">
    <form action="/comment" method="post">
        @csrf
        <input type="text" hidden name="product_id" value="{{ $product[0]->id }}">
        <div class="row">
            <div class="col-lg-11">
                <img class="img-fluid img-circle img-sm" src="../img/userIcon.png" alt="Alt Text">
            <div class="img-push">
                <input type="text" style="height: 70px;" name="content" class="form-control form-control-sm" placeholder="Press enter to post comment">
            </div>
            </div>
            <div class="col-lg-1">
                <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>
  </div>
</div>
