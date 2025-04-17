<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\District;

class StateDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $state1 = State::create(['name' => 'Maharashtra']);
        $state2 = State::create(['name' => 'Tamil Nadu']);

        District::insert([
            ['state_id' => $state1->id, 'name' => 'Mumbai'],
            ['state_id' => $state1->id, 'name' => 'Pune'],
            ['state_id' => $state2->id, 'name' => 'Chennai'],
            ['state_id' => $state2->id, 'name' => 'Coimbatore'],
        ]);
    }
}
