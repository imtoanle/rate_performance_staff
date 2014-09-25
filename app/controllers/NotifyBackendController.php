<?php
use Validators\Backend as BackendValidator;
use Carbon\Carbon;
class NotifyBackendController extends BackendBaseController
{
  public function getNotify($notifyId)
  {
    $notify = Notify::find($notifyId);
    $notify->status = 1;
    $notify->save();
    return Response::json(array('redirectUrl' => $notify->link));
  }
}