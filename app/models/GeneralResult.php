<?php
use Illuminate\Database\Eloquent\Model;
class GeneralResult extends Model
{
    /**
     * Model 'JobTitle' table
     * @var string
     */
    protected $table = 'vote_general_results';
    protected $primaryKey = 'vote_id';
    
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('user_id', 'vote_id', 'mark');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    #protected $guarded = array('id');

}