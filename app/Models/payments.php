<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'payments';
    public $incrementing = true;
}
