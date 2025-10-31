<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    //
    protected $table = 'history';
    protected $fillable = [
        'description',
        'user_id',
        'type',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
