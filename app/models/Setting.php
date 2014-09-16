<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Setting extends Model
{
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    
    /**
     * Model 'Order' table
     * @var string
     */
    protected $table = 'settings';
    protected $primaryKey = 'key';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('key', 'value');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */

    /**
     * Return the identifiant of the permission
     * @return int id of the permission
     */
    
    public function getValue()
    {
        return $this->value;
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