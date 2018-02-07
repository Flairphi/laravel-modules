<?php

namespace Flairphi\LaravelModules\Lumen;

use Flairphi\LaravelModules\Json;
use Flairphi\LaravelModules\Repository as BaseRepository;

class Repository extends BaseRepository
{
    /**
     * {@inheritdoc}
     */
    protected function createModule(...$args)
    {
        return new Module(...$args);
    }
}
