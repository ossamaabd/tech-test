<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Subscriber extends Model
{
    use HasFactory ,SoftDeletes, HasApiTokens;

    protected $table = 'subscribers';
    protected $guarded = [];


    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
