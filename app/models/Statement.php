<?php
use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{

    /**
     * Model 'Order' table
     * @var string
     */
    protected $table = 'statements';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('client_id', 'desc', 'type', 'amount', 'balance', 'sid');

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