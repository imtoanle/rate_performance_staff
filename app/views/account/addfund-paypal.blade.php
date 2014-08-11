@extends(Config::get('view.master'))
@section('content')
<div class="container">

  <div class="row">
    @include(Config::get('view.setting-nav'))
    <div class="col-md-9">

      <hr>

      <div class="row">
      <div class="col-md-12">
      <div class="ajax-alert"></div>
      <form role="form" class="form-horizontal form-groups-bordered" action="{{route('post-create-invoice')}}" method="post">
        <div class="form-group">
          <label class="col-sm-offset-2 col-sm-1 control-label">
              <h4><i class="icon icon-plus"></i><i class="icon icon-dollar"></i></h4>
          </label>

          <div class="col-sm-3">
            <div class="input-group">
              <input type="text" class="form-control text-right" style="font-size: 1.8em" name="amount_add" value="5">
            </div>
          </div>
          <label class="control-label">{{trans('all.add-fund-page.amount-add')}}</label>
        </div>


        <div class="form-group" style="margin-bottom:0;">
          <label class="col-sm-offset-2 col-sm-1 control-label">
              <h4><i class="icon icon-plus"></i><i class="icon icon-dollar"></i></h4>
          </label>

            <label class="col-sm-3 control-label text-right" style="height:48px;"><h3 id="transaction_tax"></h3></label>

          <label class="control-label">{{trans('all.add-fund-page.transaction-tax')}}</label>
        </div>

        <div class="form-group" style="margin-bottom:0;">
          <div class="col-sm-offset-3 col-sm-3">
            <hr style="margin-top:0; background: #0099E6">
          </div>
        </div>

        <div class="form-group" style="margin-bottom:0;">
          <label class="col-sm-offset-2 col-sm-1 control-label">
              <h4><i class="icon icon-dollar"></i></h4>
          </label>

            <label class="col-sm-3 control-label text-right" style="height:48px;"><h3 id="total_amount"></h3></label>

          <label class="control-label">{{trans('all.add-fund-page.total-amount')}}</label>
        </div>
        <hr>
        <div class="form-group">
          <div class="col-sm-offset-6 col-sm-8">
            <input type="submit" value="{{trans('all.add-fund-page.add-fund')}}" class="btn btn-success" data-loading-text="{{trans('all.loading')}}">
          </div>
        </div>
        {{ Form::hidden('total_amount', '') }}
        {{ Form::token() }}
      </form>
    </div>
      </div>
  </div>
</div>
</div>
        
<script>
$(document).ready(function()
{
  cal_total_amount();

  $('input[name=amount_add]').keyup(function(){
    cal_total_amount();
  });
});

function cal_total_amount()
{
  var amount_add = parseFloat(remove_not_digits($('input[name=amount_add]').val())),
    transaction_tax = parseFloat(amount_add*5/100);
  $('#transaction_tax').html(parseFloat(transaction_tax).toFixed(2));
  $('#total_amount').html(parseFloat(transaction_tax+amount_add).toFixed(2));

  $('input[name=total_amount]').val(parseFloat(transaction_tax+amount_add).toFixed(2));
}
function remove_not_digits(number) {
  return number.replace(/[^0-9]/, '');
}
</script
@stop
