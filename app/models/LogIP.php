<?php
use Illuminate\Database\Eloquent\Model;

class LogIP extends Model
{

    /**
     * Model 'Order' table
     * @var string
     */
    protected $table = 'login_logs';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('client_id','ip');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

    /**
     * Return the identifiant of the permission
     * @return int id of the permission
     */
  
    public function save(array $options = array())
    {
        //$this->validate();

        return parent::save($options);
    }

}