<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    @if($errors->any())
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong> {{$errors->first()}}
      </div>
    @endif
  </div>
</div>