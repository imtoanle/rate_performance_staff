<?php
use Illuminate\Database\Eloquent\Model;
class Notify extends Model
{
    /**
     * Model 'Permission' table
     * @var string
     */
    protected $table = 'notifys';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('user_id','content','status', 'link');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

   /*
    public function save(array $options = array())
    {
        $this->validate();

        return parent::save($options);
    }
    */
    public function user()
    {
        return $this->belongsTo('User');
    }
}