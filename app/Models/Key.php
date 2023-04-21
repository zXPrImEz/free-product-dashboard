<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    use HasFactory;

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
