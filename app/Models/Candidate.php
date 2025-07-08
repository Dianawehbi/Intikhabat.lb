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

    public function electoral_district()
    {
        return $this->belongsTo(ElectoralDistrict::class);
    }

    //refer to vote
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
