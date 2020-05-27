<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Reserve extends Model
{
    use Notifiable;

    protected $table = 'reservation_list';

    protected $fillable = [
        'tour_id', 'booking_date', 'people','email', 'phone', 'note','address'
    ];
}
