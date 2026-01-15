<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aspirasi extends Model
{
    protected $table = 'aspirasi';

    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'lokasi',
        'deskripsi',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function feedback()
    {
        return $this->hasOne(AspirasiFeedback::class);
    }

    public function progress()
    {
        return $this->hasMany(AspirasiProgress::class);
    }

    public function histories()
    {
        return $this->hasMany(AspirasiHistory::class);
    }
}
