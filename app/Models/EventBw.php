<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventBw extends Model
{
    use HasFactory;

    protected $table = 'event_bws';
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'place',
        'price',
        'is_free',
        'capacity',
        'image',
        'status',
        'category_id',
        'created_by',
    ];

    // Relations
    public function category()
    {
        return $this->belongsTo(CategoryBw::class, 'category_id');
    }

    public function creator()
    {
        return $this->belongsTo(UserBw::class, 'created_by');
    }

    public function registrations()
    {
        return $this->hasMany(RegistrationBw::class, 'event_id');
    }
}
