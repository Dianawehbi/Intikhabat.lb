<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListModel extends Model
{
    /** @use HasFactory<\Database\Factories\ListModelFactory> */
    use HasFactory;

    protected $fillable = ['name', 'party_id', 'electoral_district_id', 'election_id'];
    public function party()
    {
        return $this->belongsTo(Party::class);
    }
    public function electoral_district()
    {
        return $this->belongsTo(ElectoralDistrict::class);
    }
    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    // refer to candidate Model
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}

