<?php
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

    /**
     * Model 'Permission' table
     * @var string
     */
    protected $table = 'votes';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('title','object_entitled_vote', 'entitled_vote', 'voter');

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
}