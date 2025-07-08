<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectoralDistrict extends Model
{
    /** @use HasFactory<\Database\Factories\ElectoralDistrictFactory> */
    use HasFactory;

    protected $fillable = ['name', 'region', 'seats_available'];

    // refer to candidate class
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    //refer to eletoral district id
    public function electoral_district_seat()
    {
        return $this->hasMany(ElectoralDistrictSeat::class);
    }

    //refer to list Model
    public function list_model()
    {
        return $this->hasMany(ListModel::class);
    }

}
