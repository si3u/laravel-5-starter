<?php

namespace Bpocallaghan\Generators\Commands;

use Bpocallaghan\Generators\Migrations\NameParser;
use Bpocallaghan\Generators\Migrations\SchemaParser;
use Bpocallaghan\Generators\Migrations\SyntaxBuilder;
use Symfony\Component\Console\Input\InputOption;

class MigrationCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Migration class, and apply schema at the same time';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Migration';

    /**
     * Meta information for the requested migration.
     *
     * @var array
     */
    protected $meta;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->meta = (new NameParser)->parse($this->argumentName());

        $name = $this->qualifyClass($this->getNameInput());
        $path = $this->getPath($name);

        if ($this->files->exists($path) && $this->optionForce() === false) {
            return $this->error($this->type . ' already exists!');
        }

        $this->makeDirectory($path);
        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type . ' created successfully.');
        $this->info('- ' . $path);

        // if model is required
        if ($this->optionModel() === true || $this->optionModel() === 'true') {
            $this->call('generate:model', [
                'name'     => $this->getModelName(),
                '--plain'  => $this->optionPlain(),
                '--force'  => $this->optionForce(),
                '--schema' => $this->optionSchema()
            ]);
        }
    }

    /**
     * Build the class with the given name.
     *
     * @param  string $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        $this->replaceNamespace($stub, $name);
        $this->replaceClassName($stub);
        $this->replaceSchema($stub);
        $this->replaceTableName($stub);

        return $stub;
    }

    /**
     * Replace the class name in the stub.
     *
     * @param  string $stub
     * @return $this
     */
    protected function replaceClassName(&$stub)
    {
        $className = ucwords(camel_case($this->argumentName()));

        $stub = str_replace('{{class}}', $className, $stub);

        return $this;
    }

    /**
     * Replace the schema for the stub.
     *
     * @param  string $stub
     * @return $this
     */
    protected function replaceSchema(&$stub)
    {
        $schema = '';
        if (!$this->optionPlain()) {
            if ($schema = $this->optionSchema()) {
                $schema = (new SchemaParser)->parse($schema);
            }

            $schema = (new SyntaxBuilder)->create($schema, $this->meta);
        }

        $stub = str_replace(['{{schema_up}}', '{{schema_down}}'], $schema, $stub);

        return $this;
    }

    /**
     * Replace the table name in the stub.
     *
     * @param  string $stub
     * @return $this
     */
    protected function replaceTableName(&$stub)
    {
        $table = $this->meta['table'];

        $stub = str_replace('{{table}}', $table, $stub);

        return $this;
    }

    /**
     * Get the class name for the Eloquent model generator.
     *
     * @param null $name
     * @return string
     */
    protected function getModelName($name = null)
    {
        $name = str_singular($this->meta['table']);

        $model = '';
        $pieces = explode('_', $name);
        foreach ($pieces as $k => $str) {
            $model = $model . ucwords($str);
        }

        return $model;
    }

    /**
     * Get the path to where we should store the migration.
     *
     * @param  string $name
     * @return string
     */
    protected function getPath($name)
    {
        return './database/migrations/' . date('Y_m_d_His') . '_' . $this->argumentName() . '.php';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return config('generators.' . strtolower($this->type) . ($this->input->hasOption('plain') && $this->option('plain') ? '_plain' : '') . '_stub');
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array_merge([
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'Want a model for this table?', true],
            ['schema', 's', InputOption::VALUE_OPTIONAL, 'Optional schema to be attached to the migration', null],
        ], parent::getOptions());
    }
}