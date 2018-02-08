<?php
namespace Flairphi\LaravelModules\Traits;

trait ResourceNamingTrait{
    /**
     * Take a dirty name and return clean name
     * @param $dirty_name
     * @return string
     */
    protected function makeCleanTableName($dirty_name) : string
    {
        return $this->handleModelAndMigrationNaming($dirty_name,'_');
    }

    /**
     * @param $name
     * @return string
     */
    protected  function makeCleanMigrationClassName($name) : string
    {
        return $this->handleModelAndMigrationNaming($name);
    }


    /**
     * @param $name
     * @return string
     */
    protected function makeCleanClassName($name) : string
    {
        $list = explode('/',$name);

        return end($list);
    }

    /**
     * @param $name
     * @return string
     */
    protected function makeCleanMigrationFileName($name) : string
    {
        return $this->handleModelAndMigrationNaming($name, "_");
    }

    /**
     * @param $name
     * @param string $replace
     * @return string
     */
    private function handleModelAndMigrationNaming($name, $replace="") : string
    {
        return  str_replace('/',$replace,$name);
    }


}