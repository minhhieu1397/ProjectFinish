<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Detail extends Model
{
    use Notifiable;

    protected $table = 'detail_table';

    protected $fillable = [
        'tour_id','day_start','day_end','amount','account','description'
    ];
}
