<?php

namespace App;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = ['id'];

    public function subscription(){
        return $this->hasMany(Subscription::class);
    }

}
