<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AspirasiProgress extends Model
{
    use HasFactory;

    protected $table = 'aspirasi_progress';

    public $timestamps = false; // karena kita pakai created_at saja

    protected $fillable = [
        'aspirasi_id',
        'keterangan',
    ];

    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class);
    }
}
