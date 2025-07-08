<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    /** @use HasFactory<\Database\Factories\PartyFactory> */
    use HasFactory;

    protected $fillable = ['name', 'leader_name', 'logo', 'description'];

    //refer to list Model
    public function lists()
    {
        return $this->hasMany(ListModel::class);
    }
}
