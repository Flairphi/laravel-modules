<?php

namespace Flairphi\LaravelModules\Providers;

use Illuminate\Support\ServiceProvider;
use Flairphi\LaravelModules\Commands\CommandMakeCommand;
use Flairphi\LaravelModules\Commands\ControllerMakeCommand;
use Flairphi\LaravelModules\Commands\DisableCommand;
use Flairphi\LaravelModules\Commands\DumpCommand;
use Flairphi\LaravelModules\Commands\EnableCommand;
use Flairphi\LaravelModules\Commands\EventMakeCommand;
use Flairphi\LaravelModules\Commands\FactoryMakeCommand;
use Flairphi\LaravelModules\Commands\InstallCommand;
use Flairphi\LaravelModules\Commands\JobMakeCommand;
use Flairphi\LaravelModules\Commands\ListCommand;
use Flairphi\LaravelModules\Commands\ListenerMakeCommand;
use Flairphi\LaravelModules\Commands\MailMakeCommand;
use Flairphi\LaravelModules\Commands\MiddlewareMakeCommand;
use Flairphi\LaravelModules\Commands\MigrateCommand;
use Flairphi\LaravelModules\Commands\MigrateRefreshCommand;
use Flairphi\LaravelModules\Commands\MigrateResetCommand;
use Flairphi\LaravelModules\Commands\MigrateRollbackCommand;
use Flairphi\LaravelModules\Commands\MigrateStatusCommand;
use Flairphi\LaravelModules\Commands\MigrationMakeCommand;
use Flairphi\LaravelModules\Commands\ModelMakeCommand;
use Flairphi\LaravelModules\Commands\ModuleMakeCommand;
use Flairphi\LaravelModules\Commands\NotificationMakeCommand;
use Flairphi\LaravelModules\Commands\PolicyMakeCommand;
use Flairphi\LaravelModules\Commands\ProviderMakeCommand;
use Flairphi\LaravelModules\Commands\PublishCommand;
use Flairphi\LaravelModules\Commands\PublishConfigurationCommand;
use Flairphi\LaravelModules\Commands\PublishMigrationCommand;
use Flairphi\LaravelModules\Commands\PublishTranslationCommand;
use Flairphi\LaravelModules\Commands\RequestMakeCommand;
use Flairphi\LaravelModules\Commands\ResourceMakeCommand;
use Flairphi\LaravelModules\Commands\RouteProviderMakeCommand;
use Flairphi\LaravelModules\Commands\RuleMakeCommand;
use Flairphi\LaravelModules\Commands\SeedCommand;
use Flairphi\LaravelModules\Commands\SeedMakeCommand;
use Flairphi\LaravelModules\Commands\SetupCommand;
use Flairphi\LaravelModules\Commands\TestMakeCommand;
use Flairphi\LaravelModules\Commands\UnUseCommand;
use Flairphi\LaravelModules\Commands\UpdateCommand;
use Flairphi\LaravelModules\Commands\UseCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * The available commands
     *
     * @var array
     */
    protected $commands = [
        CommandMakeCommand::class,
        ControllerMakeCommand::class,
        DisableCommand::class,
        DumpCommand::class,
        EnableCommand::class,
        EventMakeCommand::class,
        JobMakeCommand::class,
        ListenerMakeCommand::class,
        MailMakeCommand::class,
        MiddlewareMakeCommand::class,
        NotificationMakeCommand::class,
        ProviderMakeCommand::class,
        RouteProviderMakeCommand::class,
        InstallCommand::class,
        ListCommand::class,
        ModuleMakeCommand::class,
        FactoryMakeCommand::class,
        PolicyMakeCommand::class,
        RequestMakeCommand::class,
        RuleMakeCommand::class,
        MigrateCommand::class,
        MigrateRefreshCommand::class,
        MigrateResetCommand::class,
        MigrateRollbackCommand::class,
        MigrateStatusCommand::class,
        MigrationMakeCommand::class,
        ModelMakeCommand::class,
        PublishCommand::class,
        PublishConfigurationCommand::class,
        PublishMigrationCommand::class,
        PublishTranslationCommand::class,
        SeedCommand::class,
        SeedMakeCommand::class,
        SetupCommand::class,
        UnUseCommand::class,
        UpdateCommand::class,
        UseCommand::class,
        ResourceMakeCommand::class,
        TestMakeCommand::class,
    ];

    /**
     * Register the commands.
     */
    public function register()
    {
        $this->commands($this->commands);
    }

    /**
     * @return array
     */
    public function provides()
    {
        $provides = $this->commands;

        return $provides;
    }
}
