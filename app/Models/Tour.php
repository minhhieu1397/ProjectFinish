<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tour extends Model
{
    use Notifiable;

    protected $table = 'tour';

    public function Space()
    {
        return $this->belongsTo('App\Models\Space');
    }

    protected $fillable = [
        'tour_name', 'vehicle', 'departure','day_night', 'price', 'note','img','tour_hot','place_id'
    ];
}
