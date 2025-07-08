<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdScan extends Model
{
    /** @use HasFactory<\Database\Factories\IdScanFactory> */
    use HasFactory;

    protected $fillable = ['image_path', 'extracted_date', 'matched', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
