<?php

namespace AhmedWaleed\QueryFilter;

use AhmedWaleed\QueryFilter\Console\MakeQueryScopeCommand;
use Illuminate\Support\ServiceProvider;

class QueryFilterServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        ! $this->app->runningInConsole() || $this->bootForConsole();
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Register commands
        $this->commands([
            MakeQueryScopeCommand::class
        ]);
    }
}