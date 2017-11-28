<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'is_public', 'user_id',
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function folders(){
        return $this->belongsToMany(Folder::class);
    }

    public function sharedWith(){
        return $this->belongsToMany(User::class, 'records_shared', 'record_id', 'shared_to_user');
    }

}