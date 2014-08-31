<?php
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{

    /**
     * Model 'JobTitle' table
     * @var string
     */
    protected $table = 'vote_criterias';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('key','name');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

}