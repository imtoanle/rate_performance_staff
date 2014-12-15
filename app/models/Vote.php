<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Vote extends Model
{
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
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
    protected $fillable = array('vote_code','title','object_entitled_vote', 'entitled_vote', 'voter', 'specify_user', 'expired_at', 'department_id', 'criteria', 'vote_group_id', 'rating_type');

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
    public function voteGroup()
    {
        return $this->belongsTo('VoteGroup');
    }

    public function object_entitled_vote_name()
    {
        $idsjob = explode(',', $this->object_entitled_vote);
        $jobTitles = JobTitle::select(DB::raw("group_concat(name SEPARATOR ', ') as job_names"))
        ->whereIn('id',$idsjob)->first();
        return $jobTitles->job_names;
    }

    public function department()
    {
        return $this->belongsTo('Department');
    }

    public function get_department_name()
    {
        $department = $this->department;
        return is_object($department) ? $department->name : '';
    }
}