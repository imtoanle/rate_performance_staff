        
Dear {{$recipientName}}<br /><br />

Thank you for funding your {{$company}}  account .<br /><br />

==============================================<br />
@if($addCredit)
Credit Added in Your Account : $ {{$addCredit}} <br />
============================================== <br />
@endif
@if(isset($rebateCredit))
Credit Rebated From Your Account : $ {{$rebateCredit}} <br />
============================================== <br />
@endif
<br />
Account balance after Funding : $ {{$clientAmount}} <br /><br />

{{$adminSignature}}