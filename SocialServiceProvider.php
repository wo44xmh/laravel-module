<?php namespace LaravelAcl\Social;

use App;
use Config;
use Illuminate\Support\ServiceProvider;
use LaravelAcl\Console\Commands\Inspire;
use LaravelAcl\Social\Commands\MakeUser;

class SocialServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected $providers = [
    ];

    /**
     * Register the service provider.
     *
     * @override
     * @return void
     */
    public function register()
    {
    }

    /**
     * @override
     */
    public function boot()
    {
        $this->bindClasses();

        // setup views path
        $this->loadViewsFrom(__DIR__ . '/views', 'SocialView');


        $this->registerCommands();
    }


    protected function bindClasses()
    {

    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     * @override
     */
    public function provides()
    {
        return $this->providers;
    }

    private function registerInstallCommand()
    {
        $this->app['Inspire'] = $this->app->share(function ($app) {
            return new Inspire();
        });
        $this->app['MakeUser'] = $this->app->share(function ($app) {
            return new MakeUser();
        });

        $this->commands('MakeUser');
    }

    private function registerCommands()
    {
        $this->registerInstallCommand();
    }


}
