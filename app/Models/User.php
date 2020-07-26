<?php

/**
 * Created by Reliese Model.
 */
namespace App\Models;

use Carbon\Carbon;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
class User extends Authenticatable
{
	use HasApiTokens, Notifiable;
	
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
