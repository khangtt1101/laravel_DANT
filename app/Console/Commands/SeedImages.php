<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;

class SeedImages extends Command
{
    protected $signature = 'storage:seed-images';
protected $description = 'Copy seed images to the public storage disk';

public function handle()
{
    $sourceDir = database_path('seed_images/products');
    $destDir = storage_path('app/public/products');

    if (!File::exists($destDir)) {
        File::makeDirectory($destDir, 0755, true);
    }

    $files = File::files($sourceDir);
    foreach ($files as $file) {
        File::copy($file->getPathname(), $destDir . '/' . $file->getFilename());
    }

    $this->info('Seed images have been copied successfully!');
    }
}
