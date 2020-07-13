<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $user_id
 * @property string $username
 * @property string $password
 * @property string $token
 * @property float $lat
 * @property float $lon
 * @property Carbon $token_expire
 * @property Carbon $last_access
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Analysi[] $analysis
 * @property Collection|Subscription[] $subscriptions
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';
	protected $primaryKey = 'user_id';

	protected $casts = [
		'lat' => 'float',
		'lon' => 'float'
	];

	protected $dates = [
		'token_expire',
		'last_access'
	];

	protected $hidden = [
		'password',
		'token',
		'remember_token'
	];

	protected $fillable = [
		'username',
		'password',
		'token',
		'lat',
		'lon',
		'token_expire',
		'last_access',
		'remember_token'
	];

	public function analysis()
	{
		return $this->hasMany(Analysi::class);
	}

	public function subscriptions()
	{
		return $this->hasMany(Subscription::class,'user_id');
	}
}
