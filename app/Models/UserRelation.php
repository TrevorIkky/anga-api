<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRelation
 * 
 * @property int $user_relation_id
 * @property string $relation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App
 */
class UserRelation extends Model
{
	protected $table = 'user_relations';
	public $incrementing = false;

	protected $casts = [
		'user_relation_id' => 'int'
	];

	protected $fillable = [
		'user_relation_id',
		'relation'
	];
}
