<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SocialiteUser extends Model
{
    use HasFactory;

    protected $primaryKey = ['provider_name','provider_id'];
    protected $fillable = ['user_id','provider_name','provider_id'];

    function user(){
        return $this->belongsTo(User::class);
    }


}
