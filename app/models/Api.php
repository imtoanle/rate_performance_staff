<?php
use Illuminate\Database\Eloquent\Model;

class Api extends Model
{

    /**
     * Model 'Order' table
     * @var string
     */
    protected $table = 'apis';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('name','site', 'username', 'api_key', 'type_api', 'active');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */

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

}