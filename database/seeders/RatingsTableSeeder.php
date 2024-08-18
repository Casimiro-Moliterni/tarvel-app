<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingsTableSeeder extends Seeder
{
    public function run()
    {
        // Dati di default per la tabella ratings
        $ratings = [
            ['id' => 1, 'rating' => '1', 'review' => 'Very bad experience'],
            ['id' => 2, 'rating' => '2', 'review' => 'Average experience'],
            ['id' => 3, 'rating' => '3', 'review' => 'Good experience'],
            ['id' => 4, 'rating' => '4', 'review' => 'Very good experience'],
            ['id' => 5, 'rating' => '5', 'review' => 'Exceptional experience'],
        ];

        DB::table('ratings')->insert($ratings);
    }
}