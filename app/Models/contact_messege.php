<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact_messege extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'contact_messege';
    public $incrementing = true;
}
