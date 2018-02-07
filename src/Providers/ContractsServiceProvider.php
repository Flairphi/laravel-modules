<?php

namespace Flairphi\LaravelModules\Providers;

use Illuminate\Support\ServiceProvider;
use Flairphi\LaravelModules\Contracts\RepositoryInterface;
use Flairphi\LaravelModules\Laravel\Repository;

class ContractsServiceProvider extends ServiceProvider
{
    /**
     * Register some binding.
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, Repository::class);
    }
}
