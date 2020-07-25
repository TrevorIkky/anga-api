<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subtopic
 * 
 * @property int $subtopic_id
 * @property int $topic_id
 * @property string $subtopic
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Topic $topic
 * @property Collection|Analysi[] $analysis
 * @property Collection|Subscription[] $subscriptions
 *
 * @package App
 */
class Subtopic extends Model
{
	protected $table = 'subtopics';
	protected $primaryKey = 'subtopic_id';

	protected $casts = [
		'topic_id' => 'int'
	];

	protected $fillable = [
		'topic_id',
		'subtopic'
	];

	public function topic()
	{
		return $this->belongsTo(Topic::class, 'topic_id');
	}

	public function analysis()
	{
		return $this->hasMany(Analysis::class);
	}

	public function subscriptions()
	{
		return $this->hasMany(Subscription::class);
	}
}
