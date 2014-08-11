<?php
use Illuminate\Database\Eloquent\Model;

class ServiceCat extends Model
{

    /**
     * Model 'Order' table
     * @var string
     */
    protected $table = 'service_cats';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('api_id','name', 'active', 'service_group_id');

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

    public function services()
    {
        return $this->hasMany('Service', 'imei_service_cat_id');
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

    /*
    public function validate()
    {
        if(!$name = $this->getName())
        {
            throw new NameRequiredException("A name is required for a permission, none given.");
        }

        if(!$value = $this->getValue())
        {
            throw new ValueRequiredException("A value is required for a permission, none given.");
        }

        // Check if the permission already exists
        $query = $this->newQuery();
        $persistedPermission = $query->where('value', '=', $value)->first();

        if($persistedPermission and $persistedPermission->getId() != $this->getId())
        {
            throw new PermissionExistsException("A permission already exists with value [$value], values must be unique for permissions.");
        }

        return true;
    }
    */
}