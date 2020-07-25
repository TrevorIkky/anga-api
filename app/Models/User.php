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
 * @property float|null $lat
 * @property float|null $lon
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Analysi[] $analysis
 * @property Collection|Subscription[] $subscriptions
 *
 * @package App
 */
class User extends Model
{
	protected $table = 'users';
	protected $primaryKey = 'user_id';

	protected $casts = [
		'lat' => 'float',
		'lon' => 'float'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'password',
		'lat',
		'lon'
	];

	public function analysis()
	{
		return $this->hasMany(Analysi::class);
	}

	public function subscriptions()
	{
		return $this->hasMany(Subscription::class);
	}
}
