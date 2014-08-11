<?php
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    /**
     * Model 'Order' table
     * @var string
     */
    protected $table = 'payments';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('invoice_id', 'transaction_id', 'payer_id', 'token', 'payment_type', 'status');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

    /**
     * Return description of the permission
     * @return string description of the permission
     */
    public function isActivated()
    {
        return ($this->status ? true : false);
    }

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