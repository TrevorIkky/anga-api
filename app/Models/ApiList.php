<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiList
 * 
 * @property int $api_id
 * @property int $subscription_id
 * @property string $url
 * 
 * @property Subscription $subscription
 *
 * @package App\Models
 */
class ApiList extends Model
{
	protected $table = 'api_list';
	protected $primaryKey = 'api_id';
	public $timestamps = false;

	protected $casts = [
		'subscription_id' => 'int'
	];

	protected $fillable = [
		'subscription_id',
		'url'
	];

	public function subscription()
	{
		return $this->belongsTo(Subscription::class);
	}
}
