<?php

namespace Torann\Currency\Commands;

use Torann\Currency\Currency;
use Illuminate\Console\Command;

class Manage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:manage
                                {action : Action to perform (add, remove, or update)}
                                {currencies : Name or comma separated names of the currencies}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage currency values';

    /**
     * Currency instance
     *
     * @var \Torann\Currency\Currency
     */
    protected $currency;

    /**
     * Create a new command instance.
     *
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->currency = $currency;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        // Clear cache
        $this->currency->clearCache();
        $this->comment('Currency cache cleaned.');

        // Force the system to rebuild cache
        $this->currency->getCurrencies();
        $this->comment('Currency cache rebuilt.');
    }
}