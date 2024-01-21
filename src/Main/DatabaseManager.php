<?php

namespace InstallerErag\Main;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\BufferedOutput;

class DatabaseManager
{
    /**
     * Migrate and seed the database.
     *
     * @return array
     */
    public static function MigrateAndSeed()
    {
        $dm = new DatabaseManager();
        $outputLog = new BufferedOutput;
        return $dm->migrate($outputLog);
    }

    /**
     * Run the migration and call the seeder.
     *
     * @param  \Symfony\Component\Console\Output\BufferedOutput  $outputLog
     * @return array
     */
    private function migrate(BufferedOutput $outputLog)
    {
        try {
           Artisan::call('migrate:fresh', [
                '--force' => true, // You can use --force to avoid prompts if needed
            ]);
        } catch (Exception $e) {
            return ['error', $outputLog];
        }

        return $this->seed($outputLog);
    }

    /**
     * Seed the database.
     *
     * @param  \Symfony\Component\Console\Output\BufferedOutput  $outputLog
     * @return array
     */
    private function seed(BufferedOutput $outputLog)
    {
        try {
            Artisan::call('db:seed', ['--force' => true], $outputLog);
              return ['success', $outputLog];
        } catch (Exception $e) {
            return ['error', $outputLog];
        }
    }
}
