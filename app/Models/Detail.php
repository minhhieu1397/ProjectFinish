<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use Notifiable;

    protected $table = 'detail_table';

    protected $fillable = [
        'tour_id','day_start','day_end','image','amount','account',
    ];
}
