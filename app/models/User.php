<?php
use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
class User extends SentryUserModel implements StaplerableInterface {
  use SoftDeletingTrait;
  
  use Codesleeve\Stapler\ORM\EloquentTrait;

  protected $dates = ['avatar', 'deleted_at'];
  
  public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('avatar', [
            'styles' => [
                'medium' => '300x300',
                'thumb' => '100x100'
            ]
        ]);

        parent::__construct($attributes);
    }

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

  public function notifys()
  {
      return $this->hasMany('Notify')->orderBy('created_at', 'desc');
  }

  public function unreadNotifys()
  {
      return $this->hasMany('Notify')->where('status', 0)->orderBy('created_at', 'desc')->limit(10);
  }
}