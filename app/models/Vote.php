<?php
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

    /**
     * Model 'Permission' table
     * @var string
     */
    protected $table = 'votes';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('vote_code','title','object_entitled_vote', 'entitled_vote', 'voter', 'expired_at');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

   /*
    public function save(array $options = array())
    {
        $this->validate();

        return parent::save($options);
    }
    */

    public function object_entitled_vote_name()
    {
        $idsjob = explode(',', $this->object_entitled_vote);
        $jobTitles = JobTitle::select(DB::raw("group_concat(name SEPARATOR ', ') as job_names"))
        ->whereIn('id',$idsjob)->first();
        return $jobTitles->job_names;
    }
}