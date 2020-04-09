<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\LoginToken;

class ClearExpiredLoginTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:clear-Token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clear expired login tokens';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //LoginToken::where('created_at','<',now()->subSeconds(120))->delete();

        LoginToken::expired()->delete();
    }
}
