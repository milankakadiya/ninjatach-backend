<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interest;

class InterestSeeder extends Seeder {
    public function run(): void {
        $names = ['Reading', 'Cooking', 'Watching TV', 'Basketball'];
        foreach ($names as $name) {
            Interest::create(['name' => $name]);
        }
    }
}
