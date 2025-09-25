<?php

namespace App\Console\Commands;

use App\Models\ServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class StoreServiceProvidersLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:service-providers-location';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store Sevice Provider Locations To Redis';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $providers = ServiceProvider::all();

        foreach ($providers as $provider) {
            Redis::geoadd('loc:service-providers', $provider->longitude, $provider->latitude, $provider->id);
        }
    }
}
