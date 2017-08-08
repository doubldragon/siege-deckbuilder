<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardType extends Model
{
    public function cards()
    {
        return $this->hasMany('App\Card');
    }
}
