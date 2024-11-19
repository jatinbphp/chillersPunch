<?php

namespace Database\Seeders;

use App\Models\Voting;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VotingSeeder extends Seeder
{
    public function run()
    {
        // Initialize Faker
        $faker = Faker::create();

        // Number of votes you want to create
        $votesCount = 500;  // You can change this number to however many votes you want to generate

        // Create dummy voting records
        foreach (range(1, $votesCount) as $index) {
            Voting::create([
                'competitionId' => 1,  // Fixed competitionId
                'submissionId' => random_int(1, 35),  // Random submissionId between 1 and 35
                'ipAdress' => $faker->ipv4,  // Generate a random IPv4 address
            ]);
        }
    }
}
