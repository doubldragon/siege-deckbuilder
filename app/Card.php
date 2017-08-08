<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'isMonarch', 'type', 'name','deck_points','cost','action','effect','flavor_text',
    ];

    public function deck()
    {
        return $this->belongsTo('App\Deck');
    }

    public function type()
    {
        return $this->belongsTo('App\CardType');
    }

}
