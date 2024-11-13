<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'hotels'; 
    protected $guarded = []; 

    public function categories()
    {
        return $this->hasMany(RoomRate::class, 'hotel_id');
    }
}
