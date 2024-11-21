<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MusicStyle;

class MusicStyleSeeder extends Seeder
{
    public function run()
    {
        MusicStyle::updateOrCreate(['name' => 'Crossover'], [
            'description' => 'Crossover music blends elements from two or more distinct genres, creating a unique and innovative sound that appeals to diverse audiences. It often bridges gaps between classical, pop, jazz, and other styles, pushing creative boundaries.',
        ]);
    }
}
