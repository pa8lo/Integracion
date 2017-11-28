<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type', 'status', 'space', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function records(){
        return $this->hasMany(Record::class);
    }

    public function folders(){
        return $this->hasMany(Folder::class);
    }

    public function sharedTo(){
        return $this->belongsToMany(Record::class, 'records_shared', 'shared_to_user', 'record_id');
    }

}