<?php
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    /**
     * Model 'Permission' table
     * @var string
     */
    protected $table = 'permissions';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('name','value', 'description');

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
    public function getId()
    {
        return $this->id;
    }

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
        return $this->value;
    }

    /**
     * Return description of the permission
     * @return string description of the permission
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Saves the permission.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = array())
    {
        $this->validate();

        return parent::save($options);
    }
}