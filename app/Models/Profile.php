<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //Doldurulabilir Alan
    protected $fillable=['user_id','bio','avatar'];
    //Bir Profil sadece 1 kullanıcıya Aittir.
    public function user(){
        //bolongsTo :Profili hangi kullanıcıya ait olduğunu belirtiliyor.
        return $this->belongsTo(User::class);
    }

}
