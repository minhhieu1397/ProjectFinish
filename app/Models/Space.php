<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Space extends Model
{
    use Notifiable;

    protected $table = 'space';

    protected $fillable = [
        'tour_id','space',
    ];
}
