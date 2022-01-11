<?php

namespace App\Models;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeatureImage extends Model
{
    use HasFactory;
    protected $table = 'feature_images';
    protected $fillable = ['feature_id','image_url'];

    public function room()
    {
        return $this->belongsTo(Feature::class,'feature_id','id');
    }
}
