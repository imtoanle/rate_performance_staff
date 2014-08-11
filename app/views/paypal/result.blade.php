@extends(Config::get('view.master'))
@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-12">

      <hr>
      <div class="row">
      <div class="col-md-12">
      <div class="ajax-alert text-center">
        <div class="alert alert-{{$report['type']}}">
          {{$report['message']}}
        </div>
      </div>
    </div>
      </div>
  </div>
</div>
</div>
@stop
