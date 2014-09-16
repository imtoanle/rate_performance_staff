<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class JobTitle extends Model
{
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    
    /**
     * Model 'JobTitle' table
     * @var string
     */
    protected $table = 'job_titles';

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
        $value = $this->id;
        $pattern = "^$value,|,$value,|^$value$|,$value$";
        return User::whereRaw("job_title regexp '".$pattern."'")->get();
    }

}