<?php
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    /**
     * Model 'Order' table
     * @var string
     */
    protected $table = 'invoices';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('client_id', 'item_name', 'item_price', 'item_number', 'item_qlt', 'transaction_tax', 'total_price', 'status', 'paid_at','admin_created');

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
    public function Client()
    {
        return $this->belongsTo("User");
    }

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