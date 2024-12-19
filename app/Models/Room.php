<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Rate;
class Room extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'rooms'; 
    protected $guarded = []; 

    public function rates()
    {
        return $this->hasMany(Rate::class, 'room_id', 'room_id'); // A room can have multiple rates
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class,'hotel_id','hotel_unique_id');
    }

    public function beds()
    {
        return $this->hasMany(Bed::class, 'room_id'); 
    }
}
