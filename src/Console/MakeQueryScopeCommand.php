<?php

namespace AhmedWaleed\QueryFilter\Console;

use Illuminate\Console\GeneratorCommand;

class MakeQueryScopeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new query scope filter class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Query';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (parent::handle() === false && ! $this->option('force')) {
            return false;
        }
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        return str_replace(['{{ namespace }}', '{{namespace}}'], $this->getNamespace($name), $stub);

        return $this;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/../stubs/query.stub');
    }
}