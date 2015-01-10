<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class RatingType extends Model
{

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    
    /**
     * Model 'JobTitle' table
     * @var string
     */
    protected $table = 'rating_types';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('value','name');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

}