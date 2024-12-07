<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'photo_path'
    ];
}
