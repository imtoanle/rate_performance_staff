        
Dear {{$recipientName}}<br /><br />

Thank you for funding your {{$company}}  account .<br /><br />

==============================================<br />
@if(isset($rebateCredit))
Credit Rebated From Your Invoice : $ {{$rebateCredit}} <br />
============================================== <br />
@endif
<br />
Invoice ID: {{$invoiceId}} <br />
Invoice total amount after rebate : $ {{$invoiceAmount}} <br /><br />

{{$adminSignature}}