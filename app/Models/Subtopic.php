<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subtopic
 * 
 * @property int $subtopic_id
 * @property int $subscription_id
 * @property string $subtopic
 * 
 * @property Subscription $subscription
 * @property Collection|Analysi[] $analysis
 *
 * @package App\Models
 */
class Subtopic extends Model
{
	protected $table = 'subtopics';
	protected $primaryKey = 'subtopic_id';
	public $timestamps = false;

	protected $casts = [
		'subscription_id' => 'int'
	];

	protected $fillable = [
		'subscription_id',
		'subtopic'
	];

	public function subscription()
	{
		return $this->belongsTo(Subscription::class);
	}

	public function analysis()
	{
		return $this->hasMany(Analysi::class);
	}
}
