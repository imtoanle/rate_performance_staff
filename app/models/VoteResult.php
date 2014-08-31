<?php
use Illuminate\Database\Eloquent\Model;

class VoteResult extends Model
{

    /**
     * Model 'JobTitle' table
     * @var string
     */
    protected $table = 'vote_results';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('vote_id', 'voter_id', 'entitled_vote_id', 'mark', 'content');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

}