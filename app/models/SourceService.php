<?php
use Illuminate\Database\Eloquent\Model;

class SourceService extends Model
{

    /**
     * Model 'Order' table
     * @var string
     */
    protected $table = 'source_services';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('api_id','service_cat_id', 'service_id', 'service_name', 'credit', 'delivery_time', 'info');

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