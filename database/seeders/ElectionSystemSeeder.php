<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\ElectoralDistrict;
use App\Models\ElectoralDistrictSeat;
use App\Models\IdScan;
use App\Models\ListModel;
use App\Models\Party;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElectionSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // 1. Users (for voters)
        User::factory(20)->create();

        // 2. ID Scans (optional if relevant)
        IdScan::factory(10)->create();

        // 3. Parties
        Party::factory(5)->create();

        // 4. Electoral Districts
        ElectoralDistrict::factory(6)->create();

        ElectoralDistrictSeat::factory(20)->create();

        // 5. Elections
        Election::factory(2)->create();

        // 6. Lists
        ListModel::factory(10)->create();

        // 7. Candidates (linked to lists and districts)
        Candidate::factory(30)->create();

        // 8. Votes
        Vote::factory(100)->create();
    }
}
