<?php

namespace App\Models;

use Kirschbaum\PowerJoins\PowerJoins;
use Illuminate\Support\Facades\Auth;

class Service extends NoDeleteBaseModel
{
    use PowerJoins;
    protected $fillable = [
        "name", "description", "vendor_id", "category_id", "subcategory_id", "price", "discount_price", "duration", "is_active", 'location',
    ];
    protected $appends = ['formatted_date', 'photo', 'photos'];
    protected $with = ['vendor', 'category','subcategory'];

    protected $casts = [
        'location' => "bool",
    ];

    public function scopeMine($query)
    {

        return $query->when(Auth::user()->hasRole('manager'), function ($query) {
            return $query->where('vendor_id', Auth::user()->vendor_id);
        })->when(Auth::user()->hasRole('city-admin'), function ($query) {
            return $query->where('creator_id', Auth::id());
        });
    }


    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id', 'id')->withTrashed();
    }


    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory', 'subcategory_id', 'id');
    }

    public function sales()
    {
        return $this->hasMany('App\Models\OrderService', 'service_id', 'id');
    }

    public function getPhotosAttribute()
    {
        $mediaItems = $this->getMedia('default');
        $photos = [];

        foreach ($mediaItems as $mediaItem) {
            array_push($photos, $mediaItem->getFullUrl());
        }
        return $photos;
    }

    public function getPerHourAttribute()
    {
        return $this->duration == "hour";
    }
}
