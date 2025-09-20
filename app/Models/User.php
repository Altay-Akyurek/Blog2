<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /* bire bir ilişkisi */
    public function profile(){
        return $this->hasOne(Profile::class);
    }

    //Many to Many ilişki 
    public function roles(){
        return $this->belongsToMany(Role::class,'role_user','user_id','role_id');
        //kullanıcının birden fazla Rol(ünvan) alabileceğini yaptım
    }

    public function permissions(){
        return $this->hasManyThrough(
            Permission::class,
            Role::class,
            'id',      //Role tablosunda primary key
            'role_id',//Permission Tablosundaki Foreign key
            'id',      //User tablosundaki primary key
            'id',//Role tablosundaki primary key
        );
    }
    // Kullanıcının belirli bir role sahip olup olmadığını kontrol etmek için
    public function hasRole($roleName)
    {
        return $this->roles->contains('name', $roleName);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
