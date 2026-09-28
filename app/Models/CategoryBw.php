<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryBw extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
    ];

    // Relation
    public function events()
    {
        return $this->hasMany(EventBw::class, 'category_id');
    }
}
