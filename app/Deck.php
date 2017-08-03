<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deck extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'user_id','cards',
    ];

    public function cards()
    {
        return $this->hasMany('App\Card');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

}
