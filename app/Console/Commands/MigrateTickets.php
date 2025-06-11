<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;


class MigrateTickets extends Command
{
    protected $signature = 'migrate:tickets';
    protected $description = 'Run ticket migrations on all department databases';

    public function handle()
    {
        $connections = [
            'technical_connection',
            'account_connection',
            'product_connection',
            'general_connection',
            'feedback_connection',
        ];

        foreach ($connections as $connection) {
            $this->info("Running tickets migration on: {$connection}");

            Artisan::call('migrate', [
                '--path' => 'database/migrations/shared',
                '--database' => $connection,
                '--force' => true,
            ]);

            $this->info(Artisan::output());
        }

        $this->info('Ticket migration completed on all department databases.');
    }
}
