<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cafeteria extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'amount',
        'month',
        'pocket'
    ];
}
