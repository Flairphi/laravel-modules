<?php

namespace Flairphi\LaravelModules\Commands;

use Illuminate\Support\Str;
use Flairphi\LaravelModules\Support\Config\GenerateConfigReader;
use Flairphi\LaravelModules\Support\Stub;
use Flairphi\LaravelModules\Traits\ModuleCommandTrait;
use Flairphi\LaravelModules\Traits\EntityCreateCommandPropTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ModelMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait, EntityCreateCommandPropTrait;

    /**
     * The name of argument name.
     *
     * @var string
     */
    protected $argumentName = 'model';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model for the specified module.';

    /**
     * Handle the command
     */
    public function handle()
    {
        parent::handle();
        $this->handleOptionalMigrationOption();
    }


    /**
     * Create a proper migration name:
     * ProductDetail: product_details
     * Product: products
     * @return string
     */
    private function createMigrationName()
    {
        $pieces = preg_split('/(?=[A-Z])/', $this->argument('model'), -1, PREG_SPLIT_NO_EMPTY);

        $string = '';
        foreach ($pieces as $i => $piece) {
            if ($i+1 < count($pieces)) {
                $string .= strtolower($piece) . '_';
            } else {
                $string .= Str::plural(strtolower($piece));
            }
        }
        return $string;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['model', InputArgument::REQUIRED, 'The name of model will be created.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
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
            ['fillable', null, InputOption::VALUE_OPTIONAL, 'The fillable attributes.', null],
            ['migration', 'm', InputOption::VALUE_NONE, 'Flag to create associated migrations', null],
        ];
    }

    /**
     * Create the migration file with the given model if migration flag was used
     */
    private function handleOptionalMigrationOption()
    {
        if ($this->option('migration') === true) {

            $migrationName = 'create_' . $this->createMigrationName() . '_table';

            $this->call('module:make-migration', ['name' => $migrationName, 'module' => $this->argument('module')]);
        }
    }

    /**
     * @return mixed
     */
    protected function getTemplateContents()
    {
        //configure
        $this->currentModule($this->getModuleName())
                ->isPrefixed()
                ->tableIs($this->createMigrationName());

        $table = ($this->shouldHaveModulePrefix) ? $this->getPrefixedTableName() : $this->table;

        //check if uuid_id used
        $primary_key            = $this->getUuidPrimaryKeyName();
        $uuid_trait_namespace   = "";
        $uuid_trait_name        = "";
        $incrementing              = "";

        if($this->useBinaryUuid()){
            $uuid_trait_namespace       = "use ".$this->getBinaryUuidTraitNamespace();
            $uuid_trait_name            = ", ".$this->getBinaryUuidTraitName();
            $incrementing               = 'protected $incrementing = false;';
        }

        return (new Stub('/model.stub', [
            'NAME'              => $this->getModelName(),
            'FILLABLE'          => $this->getFillable(),
            'NAMESPACE'         => $this->getClassNamespace($this->module),
            'CLASS'             => $this->getClass(),
            'LOWER_NAME'        => $this->module->getLowerName(),
            'MODULE'            => $this->getModuleName(),
            'TABLE_NAME'        => $table,
            'STUDLY_NAME'       => $this->module->getStudlyName(),
            'MODULE_NAMESPACE'  => $this->laravel['modules']->config('namespace'),
            'UUID_TRAIT_NAMESPACE'  => $uuid_trait_namespace,
            'UUID_TRAIT_NAME'       => $uuid_trait_name,
            'PRIMARY_KEY'           => $primary_key,
            'INCREMENTING'          => $incrementing
        ]))->render();
    }

    /**
     * @return mixed
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $modelPath = GenerateConfigReader::read('model');

        return $path . $modelPath->getPath() . '/' . $this->getModelName() . '.php';
    }

    /**
     * @return mixed|string
     */
    private function getModelName()
    {
        return Str::studly($this->argument('model'));
    }

    /**
     * @return string
     */
    private function getFillable()
    {
        $fillable = $this->option('fillable');

        if (!is_null($fillable)) {
            $arrays = explode(',', $fillable);

            return json_encode($arrays);
        }

        return '[]';
    }

    /**
     * Get default namespace.
     *
     * @return string
     */
    public function getDefaultNamespace() : string
    {
        return $this->laravel['modules']->config('paths.generator.model.path', 'Entities');
    }
}
