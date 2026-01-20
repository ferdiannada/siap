<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspirasiFeedback extends Model
{
    use HasFactory;

    protected $table = 'aspirasi_feedback';

    protected $fillable = [
        'aspirasi_id',
        'admin_id',
        'feedback',
    ];

    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
