<?php

namespace Flairphi\LaravelModules\Commands;

use Flairphi\LaravelModules\Traits\EntityCreateCommandPropTrait;
use Illuminate\Support\Str;
use Flairphi\LaravelModules\Support\Config\GenerateConfigReader;
use Flairphi\LaravelModules\Support\Migrations\NameParser;
use Flairphi\LaravelModules\Support\Migrations\SchemaParser;
use Flairphi\LaravelModules\Support\Stub;
use Flairphi\LaravelModules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MigrationMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait, EntityCreateCommandPropTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new migration for the specified module.';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The migration name will be created.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be created.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['fields', null, InputOption::VALUE_OPTIONAL, 'The specified fields table.', null],
            ['plain', null, InputOption::VALUE_NONE, 'Create plain migration.'],
        ];
    }

    /**
     * Get schema parser.
     *
     * @return SchemaParser
     */
    public function getSchemaParser()
    {
        return new SchemaParser($this->option('fields'));
    }

    /**
     * @throws \InvalidArgumentException
     *
     * @return mixed
     */
    protected function getTemplateContents()
    {
        $parser = new NameParser($this->argument('name'));

        //configuration

        $this->currentModule($this->getModuleName())
             ->isPrefixed()
             ->tableIs($parser->getTableName());

        $table = ($this->shouldHaveModulePrefix) ? $this->getPrefixedTableName() : $this->table;

        $createStub="create";

        if($this->useBinaryUuid()){
            $createStub = "createUuid";
        }

        if ($parser->isCreate()) {
            return Stub::create('/migration/'.$createStub.'.stub', [
                'class' => $this->getClass(),
                'table' => $table, //$parser->getTableName(),
                'fields' => $this->getSchemaParser()->render(),
                'primary_key' => $this->getUuidPrimaryKeyName(),
            ]);
        } elseif ($parser->isAdd()) {
            return Stub::create('/migration/add.stub', [
                'class' => $this->getClass(),
                'table' =>  $table, //$parser->getTableName(),
                'fields_up' => $this->getSchemaParser()->up(),
                'fields_down' => $this->getSchemaParser()->down(),
            ]);
        } elseif ($parser->isDelete()) {
            return Stub::create('/migration/delete.stub', [
                'class' => $this->getClass(),
                'table' => $table, //$parser->getTableName(),
                'fields_down' => $this->getSchemaParser()->up(),
                'fields_up' => $this->getSchemaParser()->down(),
            ]);
        } elseif ($parser->isDrop()) {
            return Stub::create('/migration/drop.stub', [
                'class' => $this->getClass(),
                'table' => $table, //$parser->getTableName(),
                'fields' => $this->getSchemaParser()->render(),
            ]);
        }

        return Stub::create('/migration/plain.stub', [
            'class' => $this->getClass(),
        ]);
    }

    /**
     * @return mixed
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $generatorPath = GenerateConfigReader::read('migration');

        return $path . $generatorPath->getPath() . '/' . $this->getFileName() . '.php';
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return date('Y_m_d_His_') . $this->makeCleanMigrationFileName($this->getSchemaName());
    }

    /**
     * @return array|string
     */
    private function getSchemaName()
    {
        return $this->argument('name');
    }

    /**
     * @return string
     */
    private function getClassName()
    {
        $className = Str::studly($this->argument('name'));

        return $this->makeCleanMigrationClassName($className);
    }

    public function getClass()
    {
        return $this->getClassName();
    }

    /**
     * Run the command.
     */
    public function handle()
    {
        parent::handle();

        if (app()->environment() === 'testing') {
            return;
        }
        $this->call('optimize');
    }
}
