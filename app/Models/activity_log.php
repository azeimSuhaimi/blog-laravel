<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activity_log extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'activity_log';
    public $incrementing = true;

    public function record_activity( $action = '')
    {
        $this->username = auth()->user()->username;
        $this->action = $action;
        // ...
        $this->save();
    }
}
