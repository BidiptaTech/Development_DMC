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
        return $this->belongsTo(Rate::class, 'rate_id');    
    }
}
