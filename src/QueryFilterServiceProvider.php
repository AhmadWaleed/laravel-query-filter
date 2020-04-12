<?php

namespace AhmedWaleed\QueryFilter;

use Illuminate\Support\ServiceProvider;
use AhmedWaleed\QueryFilter\Console\MakeQueryScopeCommand;

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