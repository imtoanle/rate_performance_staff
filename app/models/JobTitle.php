<?php
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{

    /**
     * Model 'JobTitle' table
     * @var string
     */
    protected $table = 'job_titles';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('name');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

}