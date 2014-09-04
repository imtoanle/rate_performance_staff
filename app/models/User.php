<?php
use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;
class User extends SentryUserModel {
  
  public function job_titles_name()
  {
    $idsjob = explode(',', $this->job_title);
    $jobTitles = JobTitle::select(DB::raw("group_concat(name SEPARATOR ', ') as group_name"))
    ->whereIn('id',$idsjob)->first();
    return $jobTitles->group_name;
  }

  public function department()
  {
      return $this->belongsTo('Department');
  }
}