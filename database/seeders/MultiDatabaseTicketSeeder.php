<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MultiDatabaseTicketSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Define connection-to-type mapping
        $map = [
            'technical_connection' => 'Technical Issues',
            'account_connection'   => 'Account & Billing',
            'product_connection'   => 'Product & Service',
            'general_connection'   => 'General Inquiry',
            'feedback_connection'  => 'Feedback & Suggestions',
        ];

        foreach ($map as $connection => $type) {
            for ($i = 0; $i < 3; $i++) {
                DB::connection($connection)->table('tickets')->insert([
                    'name' => $faker->name,
                    'email' => $faker->safeEmail,
                    'subject' => $faker->sentence(4),
                    'message' => $faker->paragraph,
                    'type' => $type,
                    'status' => 'Open',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $this->command->info("Seeded 3 tickets for {$type} in [{$connection}]");
        }
    }
}
