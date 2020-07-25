<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRelationsMapping
 * 
 * @property int $user_relations_mapping_id
 * @property int $relation_start
 * @property int $relation_to
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App
 */
class UserRelationsMapping extends Model
{
	protected $table = 'user_relations_mapping';
	protected $primaryKey = 'user_relations_mapping_id';

	protected $casts = [
		'relation_start' => 'int',
		'relation_to' => 'int'
	];

	protected $fillable = [
		'relation_start',
		'relation_to'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'relation_to');
	}
}
