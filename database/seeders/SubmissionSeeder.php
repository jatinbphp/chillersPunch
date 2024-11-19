<?php

namespace Database\Seeders;

use App\Models\Submission;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SubmissionSeeder extends Seeder
{
    public function run()
    {
        // Initialize Faker
        $faker = Faker::create();

        // Create 10 dummy submissions
        foreach (range(1, 25) as $index) {
            Submission::create([
                'competitionId' => $faker->randomNumber(5),
                'fullName' => $faker->name,
                'phoneNumber' => $faker->phoneNumber,
                'emailAddress' => $faker->email,
                'videoFile' => $faker->word . '.mp4',
                'status' => $faker->randomElement(['pending', 'approved', 'rejected']),
                'isWinner' => $faker->boolean,
            ]);
        }
    }
}
