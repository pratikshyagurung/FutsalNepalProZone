<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FutsalOwnerSeeder extends Seeder
{
    public function run()
    {
        DB::table('futsal_owners')->insert([
            'name' => 'Futsal Owner 1',
        ]);
    }
}
