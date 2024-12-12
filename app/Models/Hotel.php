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

    public function rooms()
    {
        return $this->hasMany(Room::class, 'hotel_id'); // Assuming `hotel_id` is the foreign key in the `rooms` table
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'category_id');
    }

}
