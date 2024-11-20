<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Submission;
use App\Models\Competition;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a Faker instance
        $faker = Faker::create();

        // Loop to create 100 records
        for ($i = 0; $i < 100; $i++) {
            // Fetch a random competition from the database
            $competition = Competition::inRandomOrder()->first(); // Get a random competition

            // Check if a competition exists to avoid errors if the table is empty
            if ($competition) {
                $competitionId = $competition->id; // Use the competition's ID
            } else {
                // Handle the case where there are no competitions in the table
                $competitionId = 1; // Assuming a default competition exists with ID = 1
            }

            // Create a new submission with fake data
            Submission::create([
                'competitionId' => $competitionId, // Use the fetched competition ID
                'fullName' => $faker->name, // Generate a fake name
                'emailAddress' => $faker->email, // Generate a fake email
                'phoneNumber' => $faker->phoneNumber, // Generate a fake phone number
                'status' => 'pending', // Static value
                'videoFile' => $faker->word . '.mp4',
                'isWinner' => $faker->boolean(50), // Randomly assign true/false (50% chance)
            ]);
        }
    }
}
