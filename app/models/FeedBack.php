<?php
use Illuminate\Database\Eloquent\Model;

class FeedBack extends Model
{

    /**
     * Model 'Order' table
     * @var string
     */
    protected $table = 'feedbacks';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('name', 'email', 'subject', 'content', 'type');

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
    

    /**
     * Return the name of the permission
     * @return string name of the permission
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return the value of the permission
     * @return string value of the permission
     */
    public function getValue()
    {
        return $this->credit;
    }

    /**
     * Return description of the permission
     * @return string description of the permission
     */
    public function isActivated()
    {
        return ($this->active ? true : false);
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