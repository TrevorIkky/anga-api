<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Topic
 * 
 * @property int $topic_id
 * @property string $topic
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Subtopic[] $subtopics
 *
 * @package App
 */
class Topic extends Model
{
	protected $table = 'topic';
	protected $primaryKey = 'topic_id';

	protected $fillable = [
		'topic'
	];

	public function subtopics()
	{
		return $this->hasMany(Subtopic::class);
	}
}
