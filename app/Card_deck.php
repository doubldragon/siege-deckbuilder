<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card_deck extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['deck_id','card_id','quantity',"deleted_at"];


    public function deck()
    {
        return $this->belongsTo('App\Deck');
    }

    public function card()
    {
        return $this->belongsTo('App\Card');
    }
}
