<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Place extends Model
{
    use Notifiable;

    protected $table = 'place';

    public function tour()
    {
        return $this->hasMany('App\Models\Tour');
    }

    protected $fillable = [
        'place',
    ];
}
