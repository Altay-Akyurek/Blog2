<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['content','user_id'];

    //Polimorfig ilişki
    public function commentable(){
        return  $this->morphTo();
    }

    //Yorum yazan kullanıcı Tarafı
    public function user(){
        return $this->belongsTo(User::class);
    }
}
