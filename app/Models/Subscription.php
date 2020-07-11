<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscription
 * 
 * @property int $subscription_id
 * @property int $user_id
 * @property string $topic
 * 
 * @property User $user
 * @property Collection|ApiList[] $api_lists
 * @property Collection|Subtopic[] $subtopics
 *
 * @package App\Models
 */
class Subscription extends Model
{
	protected $table = 'subscriptions';
	protected $primaryKey = 'subscription_id';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'topic'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function api_lists()
	{
		return $this->hasMany(ApiList::class);
	}

	public function subtopics()
	{
		return $this->hasMany(Subtopic::class);
	}
}
