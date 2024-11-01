<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $guarded = false;
    protected $fillable = [
        'order_id',
        'ticket_type_id',
        'barcode',
    ];
}
