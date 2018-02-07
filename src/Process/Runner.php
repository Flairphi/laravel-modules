<?php

namespace Flairphi\LaravelModules\Process;

use Flairphi\LaravelModules\Contracts\RunableInterface;
use Flairphi\LaravelModules\Repository;

class Runner implements RunableInterface
{
    /**
     * The module instance.
     *
     * @var \Flairphi\LaravelModules\Repository
     */
    protected $module;

    /**
     * The constructor.
     *
     * @param \Flairphi\LaravelModules\Repository $module
     */
    public function __construct(Repository $module)
    {
        $this->module = $module;
    }

    /**
     * Run the given command.
     *
     * @param string $command
     */
    public function run($command)
    {
        passthru($command);
    }
}
