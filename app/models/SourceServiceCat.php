<?php
use Illuminate\Database\Eloquent\Model;

class SourceServiceCat extends Model
{

    /**
     * Model 'Order' table
     * @var string
     */
    protected $table = 'source_cats';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('api_id','name');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

    /**
     * Saves the permission.
     *
     * @param  array  $options
     * @return bool
     */

    public function services()
    {
        return $this->hasMany('SourceService', 'service_cat_id');
    }

    public function save(array $options = array())
    {
        //$this->validate();

        return parent::save($options);
    }

    /**
     * Validate permissions
     * @return bool
     */
}