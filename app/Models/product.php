<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\{HasMedia, InteractsWithMedia};
use Illuminate\Database\Eloquent\Factories\HasFactory;


class product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'product_name',
        'product_id',
        'price',
        'previous_price',
        'quantity',
        'alert_quantity',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
