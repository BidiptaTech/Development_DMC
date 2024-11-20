<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $table = 'room_type'; 
    protected $fillable = [
        'name',          // Room type name
        'breakfast',     // Availability of breakfast
        'lunch',         // Availability of lunch
        'dinner',        // Availability of dinner
        'extra_bed',     // Availability of extra bed
        
        'facilities',    // Facilities (stored as JSON)
        'inserted_by_user',
        'description',   // Room description
        'status',        // Active or Inactive
        'hotel_id',      // Associated hotel ID
    ];
}
