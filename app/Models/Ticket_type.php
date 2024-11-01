<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket_type extends Model
{
    protected $table = 'ticket_types';
    protected $guarded = false;
    protected $fillable = [
        'name',
        'price',
    ];
}
