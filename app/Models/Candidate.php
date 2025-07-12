<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    /** @use HasFactory<\Database\Factories\CandidateFactory> */
    use HasFactory;

    protected $fillable = ['full_name', 'sect', 'position', 'list_models_id', 'electoral_district_id', 'won', 'votes_count'];

    public function list_model()
    {
        return $this->belongsTo(ListModel::class);
    }

    //refer to vote
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function election()
    {
        return $this->belongsTo(\App\Models\Election::class);
    }

    public function party()
    {
        return $this->belongsTo(\App\Models\Party::class);
    }

    public function electoralDistrict()
    {
        return $this->belongsTo(\App\Models\ElectoralDistrict::class);
    }
}
