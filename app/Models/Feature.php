<?php

namespace App\Models;

use App\Models\FeatureImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory;
    protected $table = 'features';
    protected $fillable = ['title','description','image_url','subtitle'];

    
    public function featureImages()
    {
        return $this->hasMany(FeatureImage::class,'feature_id','id');
    }
}
