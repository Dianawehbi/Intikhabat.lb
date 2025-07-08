<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectoralDistrictSeat extends Model
{
    /** @use HasFactory<\Database\Factories\ElectoralDistrictSeatFactory> */
    use HasFactory;
    protected $fillable = ['electoral_district_id', 'sect', ' seat_count'];
    public function electoral_district()
    {
        return $this->belongsTo(ElectoralDistrict::class);
    }
}