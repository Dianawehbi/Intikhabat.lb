<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    /** @use HasFactory<\Database\Factories\ElectionFactory> */
    use HasFactory;

    protected $fillable = ['name', 'start_date', 'end_date', 'election_type'];

    // refer to list_model
    public function list_model()
    {
        return $this->hasMany(ListModel::class);
    }

    //refer to votes
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
