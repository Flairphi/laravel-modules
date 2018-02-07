<?php

namespace Flairphi\LaravelModules\Traits;

trait EntityCreateCommandPropTrait {


    /**
     * @var Collection
     */
    protected $module;

    /**
     * @var bool 
     */
    protected $shouldHaveModulePrefix = false;

    /**
     * @var string 
     */
    protected $table = "";

    /**
     * @param bool $prefixed
     * @return $this
     */
    protected function isPrefixed($prefixed = false ){

       $this->shouldHaveModulePrefix = ($prefixed) ? $prefixed : app('modules')->config('generator.models.module_prefix');

       return $this;
    }

    /**
     * @param $tableName
     * @return $this
     */
    protected function tableIs($tableName){

        $this->table = $tableName;

        return $this;
    }

    /**
     * @param $name
     * @return $this
     */
    protected function currentModule($name){

        $module = app('modules')->findOrFail($name);

        $this->module = $module;

        return $this;
    }

    /**
     * @return string
     */
    protected function getPrefixedTableName(): string {
        return $this->module->getLowerName()."__".$this->table;
    }

    /**
     * @return bool
     */
    protected  function useBinaryUuid() : bool
    {
        return app('modules')->config('generator.models.use_binary_uuid');
    }

    /**
     * @return mixed
     */
    protected function getUuidPrimaryKeyName(){
        return app('modules')->config('generator.models.primary_key');
    }

    /**
     * @return mixed
     */
    protected  function getBinaryUuidTraitNamespace(){
        return app('modules')->config('generator.models.trait_namespace');
    }

    /**
     * @return mixed
     */
    protected  function getBinaryUuidTraitName(){
        return app('modules')->config('generator.models.trait_name');
    }

}