<?php

namespace App\Models;

use App\Models\RoomType;
use App\Models\RoomImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = ['name','description','price','image_url','subtitle','room_facility','home_type_id'];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class,'home_type_id','id');
    }
    
    public function roomImages()
    {
        return $this->hasMany(RoomImage::class,'room_id','id');
    }
}
