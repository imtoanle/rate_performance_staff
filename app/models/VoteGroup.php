<?php
use Illuminate\Database\Eloquent\Model;

class VoteGroup extends Model
{

    /**
     * Model 'JobTitle' table
     * @var string
     */
    protected $table = 'vote_groups';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('vote_code', 'title', 'head_department', 'status');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

    public function votes()
    {
        return $this->hasMany('Vote');
    }

    public function delete()
    {
        Vote::where("vote_group_id", $this->id)->delete();
        return parent::delete();
    }

    public function check_status()
    {
        $count = Vote::where('vote_group_id', $this->id)
            ->where('status', Config::get("variable.vote-status.newly"))
            ->whereOr('status', Config::get("variable.vote-status.opened"))
            ->count();

        return $count;
    }

    public function copy_item()
    {
        
    }
}