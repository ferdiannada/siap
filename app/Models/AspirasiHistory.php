<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AspirasiHistory extends Model
{
    use HasFactory;

    protected $table = 'aspirasi_histories';

    public $timestamps = false;

    protected $fillable = [
        'aspirasi_id',
        'status_lama',
        'status_baru',
        'admin_id',
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
