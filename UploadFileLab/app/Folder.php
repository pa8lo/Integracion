<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
     use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'folder_hash', 'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function files(){
        return $this->belongsToMany(Record::class);
    }
}
