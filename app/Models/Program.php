<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use Notifiable;

    protected $table = 'programs';

    protected $fillable = [
        'tour_id', 'title', 'day','detail',
    ];
}
