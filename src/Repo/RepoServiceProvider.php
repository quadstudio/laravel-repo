<?php

namespace QuadStudio\Repo;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class RepoServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function register()
    {
    }


    public function boot()
    {

        $this->publishTranslations();

        $this->publishConfig();

        $this->extendBlade();

        $this->loadViews();

    }

    private function publishTranslations()
    {

        $this->loadTranslationsFrom($this->packagePath('resources/lang'), 'repo');

        $this->publishes([
            $this->packagePath('resources/lang') => resource_path('lang/vendor/repo'),
        ], 'translations');
    }

    private function packagePath($path)
    {
        return __DIR__ . "/../{$path}";
    }

    private function publishConfig()
    {

        $this->mergeConfigFrom(
            $this->packagePath('config/repo.php'), 'repo'
        );

        $this->mergeConfigFrom(
            $this->packagePath('config/tag.php'), 'tag'
        );

        $this->mergeConfigFrom(
            $this->packagePath('config/global.php'), 'global'
        );

        $this->publishes([
            $this->packagePath('config/repo.php') => config_path('repo.php'),
        ], 'config');

        $this->publishes([
            $this->packagePath('config/tag.php') => config_path('tag.php'),
        ], 'config');

        $this->publishes([
            $this->packagePath('config/global.php') => config_path('global.php'),
        ], 'config');
    }

    private function loadViews()
    {
        $viewsPath = $this->packagePath('resources/views/');

        $this->loadViewsFrom($viewsPath, 'repo');

        $this->publishes([
            $viewsPath => resource_path('views/vendor/repo'),
        ], 'views');
    }

    private function extendBlade()
    {
        if (class_exists('\Blade')) {
            Blade::component('repo::filter', 'filter');
        }
    }
}