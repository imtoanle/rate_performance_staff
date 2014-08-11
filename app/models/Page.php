<?php
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    /**
     * Model 'Order' table
     * @var string
     */
    protected $table = 'pages';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('name', 'title', 'content');

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