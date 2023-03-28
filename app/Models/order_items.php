<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_items extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'order_items';
    public $incrementing = true;
}
