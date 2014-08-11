<?php
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    /**
     * Model 'Order' table
     * @var string
     */
    protected $table = 'comments';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('client_id', 'content', 'type', 'parent_comment_id', 'blog_id');

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
    public function getAuthor()
    {
        $user = Client::find($this->client_id);
        return $user ? $user : null;
    }
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