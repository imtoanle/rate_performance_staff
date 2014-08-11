<?php
use Illuminate\Database\Eloquent\Model;

class ClientGroup extends Model
{

    /**
     * Model 'Order' table
     * @var string
     */
    protected $table = 'clientgroups';

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