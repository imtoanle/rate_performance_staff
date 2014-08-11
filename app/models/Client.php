<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Client extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable = array('username', 'name', 'email', 'password', 'password_temp', 'code', 'active', 'phone', 'address', 'city', 'state', 'zip_code', 'country', 'language', 'security_question', 'security_answer', 'security_login', 'amount', 'clientgroup_id');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'clients';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}

	public function group()
	{
		return $this->belongsTo('ClientGroup', 'clientgroup_id');
	}

	public function percent_orders()
	{
		$arrAllOrders = Order::where('client_id', '=', $this->id)->get();
		$total_order = count($arrAllOrders) ? count($arrAllOrders) : 1;
		$arrCount = array(
			'pending_order' => 0,
			'denied_order' => 0,
			'completed_order' => 0,
			);
		foreach ($arrAllOrders as $order) {
			switch ($order->status) {
				case Config::get('variable.order-status.pending'):
					$arrCount['pending_order']++;
					break;
				case Config::get('variable.order-status.denied'):
					$arrCount['denied_order']++;
					break;
				case Config::get('variable.order-status.completed'):
					$arrCount['completed_order']++;
					break;
			}
		}
		$arr_percent = array(
			'pending_order' => number_format(($arrCount['pending_order']/$total_order*100), 2),
			'denied_order' => number_format(($arrCount['denied_order']/$total_order*100), 2),
			'completed_order' => number_format(($arrCount['completed_order']/$total_order*100), 2),
			);
		return $arrResults = array(
			'count' => $arrCount,
			'percent' => $arr_percent);
	}

}