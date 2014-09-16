<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Database\Eloquent\Model;
class Department extends Model
{
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    
    /**
     * Model 'JobTitle' table
     * @var string
     */
    protected $table = 'departments';

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

    public function users()
    {
        #return User::whereDepartmentId($this->id)->get();
        return $this->hasMany('User');
    }


    public function getName()
    {
        return $this->name;
    }

}