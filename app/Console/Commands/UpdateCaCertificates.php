<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateCaCertificates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ssl:update-ca {--force : Force download even if file exists}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download and update CA certificate bundle for SSL verification';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $caCertPath = storage_path('cacert.pem');

        if (file_exists($caCertPath) && !$this->option('force')) {
            if (!$this->confirm('CA certificate already exists. Do you want to update it?')) {
                $this->info('CA certificate update cancelled.');
                return 0;
            }
        }

        $this->info('Downloading CA certificate bundle from Mozilla...');

        try {
            // Download the latest CA bundle from Mozilla
            $response = Http::timeout(60)->get('https://curl.se/ca/cacert.pem');

            if ($response->successful()) {
                file_put_contents($caCertPath, $response->body());
                $this->info('CA certificate bundle downloaded successfully!');
                $this->line("Location: {$caCertPath}");

                // Verify the downloaded file
                $fileSize = filesize($caCertPath);
                $this->line("File size: " . number_format($fileSize) . " bytes");

                return 0;
            } else {
                $this->error('Failed to download CA certificate bundle.');
                $this->error('HTTP Status: ' . $response->status());
                return 1;
            }
        } catch (\Exception $e) {
            $this->error('Error downloading CA certificate: ' . $e->getMessage());
            return 1;
        }
    }
}
