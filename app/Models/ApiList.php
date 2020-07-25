<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiList
 * 
 * @property int $api_id
 * @property string $url
 *
 * @package App
 */
class ApiList extends Model
{
	protected $table = 'api_list';
	protected $primaryKey = 'api_id';
	public $timestamps = false;

	protected $fillable = [
		'url'
	];
}
