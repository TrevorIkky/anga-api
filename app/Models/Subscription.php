<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscription
 * 
 * @property int $subscription_id
 * @property int $user_id
 * @property int $subtopic_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Subtopic $subtopic
 * @property User $user
 *
 * @package App
 */
class Subscription extends Model
{
	protected $table = 'subscriptions';
	protected $primaryKey = 'subscription_id';

	protected $casts = [
		'user_id' => 'int',
		'subtopic_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'subtopic_id'
	];

	public function subtopic()
	{
		return $this->belongsTo(Subtopic::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
