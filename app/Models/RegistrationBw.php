<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrationBw extends Model
{
    use HasFactory;

    protected $table = 'registration__bws';

    protected $fillable = [
        'user_id',
        'event_id'
    ];

    public function user()
    {
        return $this->belongsTo(UserBw::class);
    }

    public function event()
    {
        return $this->belongsTo(EventBw::class, 'event_id');
    }
}
