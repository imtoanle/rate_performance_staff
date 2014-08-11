@extends(Config::get('view.master'))
@section('content')
<div class="container">

  <div class="row">
    @include(Config::get('view.setting-nav'))
    <div class="col-md-9">

      <div class="row">
      <div class="col-md-12">
      <div class="ajax-alert"></div>
      <form role="form" class="form-horizontal form-groups-bordered" action="{{route('paypal-process')}}" method="post">
        <div class="invoice">
          <div class="row">
            <div class="col-sm-6 text-left">
              <a href="index.html#">
                <img src="../../assets/images/laborator.png" />
              </a>
            </div>
            
            <div class="col-sm-6 text-right">
                <h3>{{trans('all.invoice-page.invoice-no')}}. #{{$invoice->id}}</h3>
                <span>{{$invoice->created_at->format('d M Y')}}</span>
            </div>
            
          </div>
          
          
          <hr class="margin" />
          

          <div class="form-group">
          
            <div class="col-sm-3 text-left">
            
              <h4>{{trans('all.client')}}</h4>
              <i class="icon icon-user"></i> {{$client->username}}
              <br />
              <i class="icon icon-envelope"></i> {{$client->email}}
              
            </div>
          
            <div class="col-sm-3 text-left">
               
              <h4>&nbsp;</h4>
              {{$client->address}} {{$client->city}}
              <br />
              {{$client->state}} {{$client->country}}
              <br />
              {{$client->phone}}
            </div>
            
            <div class="col-md-6 text-right">
              <h4>{{trans('all.invoice-page.payment-detail')}}</h4>
              <strong>{{trans('all.invoice-page.sender')}}:</strong> {{$client->name}}
              <br />
              <strong>{{trans('all.invoice-page.receiver')}}:</strong> APUNLOCK
            </div>
            
          </div>
          
          <div class="margin"></div>
          
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th width="60%">{{trans('all.invoice-page.product')}}</th>
                <th>{{trans('all.invoice-page.quantity')}}</th>
                <th>{{trans('all.invoice-page.price')}}</th>
              </tr>
            </thead>
            
            <tbody>
              <tr>
                <td class="text-center">1</td>
                <td>{{$invoice->item_name}}</td>
                <td>{{$invoice->item_qlt}}</td>
                <td class="text-right">${{$invoice->item_price}}</td>
              </tr>
            </tbody>
          </table>
          
          <div class="margin"></div>

          <div class="row">
          
            <div class="col-sm-6">
            
              <div class="text-left">
                APUNLOCK
                <br />
                {{ $setting_vars['address'] }}
                <br />
                {{ $setting_vars['phone'] }}
                <br />
                {{ $setting_vars['email'] }}
              </div>
            
            </div>
            
            <div class="col-sm-6">
              
              <div class="text-right">
                
                <ul class="list-unstyled">
                  <li>
                    {{trans('all.invoice-page.sub-total')}}: 
                    <strong>${{$invoice->item_price}}</strong>
                  </li>
                  <li>
                    {{trans('all.invoice-page.transaction-tax')}}: 
                    <strong>5%</strong>
                  </li>
                  <li>
                    {{trans('all.invoice-page.discount')}}: 
                    -----
                  </li>
                  <li>
                    {{trans('all.invoice-page.grand-total')}}:
                    <strong>${{$invoice->total_price}}</strong>
                  </li>
                </ul>
                
                <br />
                
                <a href="javascript:window.print();" class="btn btn-primary btn-icon icon-left hidden-print">
                  <i class="icon icon-print"></i>
                  {{trans('all.invoice-page.print-invoice')}}
                </a>
                
                &nbsp;
                
                <button type="submit" class="btn btn-success btn-icon icon-left hidden-print">
                  <i class="icon icon-shopping-cart"></i>
                  {{trans('all.invoice-page.pay-invoice')}}
                </button>
              </div>
              
            </div>
            
          </div>
        </div>
        {{ Form::hidden('invoice_id', $invoice->id) }}
        {{ Form::hidden('item_price', $invoice->item_price) }}
        {{ Form::token() }}
      </form>
    </div>
      </div>
  </div>
</div>

@stop
