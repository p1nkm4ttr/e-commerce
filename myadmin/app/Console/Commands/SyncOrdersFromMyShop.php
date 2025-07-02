<?php

namespace App\Console\Commands;

use App\Services\OrderService;
use Illuminate\Console\Command;

class SyncOrdersFromMyShop extends Command
{
    protected $signature = 'orders:sync-to-admin';
    protected $description = 'Sync orders from MyShop to admin system';

    public function handle()
    {
        $this->info('Starting order sync...');
        
      
        $this->info('Orders sync completed!');
        return Command::SUCCESS;
    }
}