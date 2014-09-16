<?php
use Cartalyst\Sentry\Groups\Eloquent\Group as SentryGroupModel;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Group extends SentryGroupModel {
  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];    
}