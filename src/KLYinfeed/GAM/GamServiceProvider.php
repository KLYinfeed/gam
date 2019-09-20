<?php

namespace KLYinfeed\GAM;

use Illuminate\Support\ServiceProvider;
use KLYinfeed\GAM\Contracts\Factory;

class GamServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../../config/config.php';
        
        $paths = [
            $configPath => config_path("infeed_gam.php"),
        ];
        
        $this->publishes($paths, 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Factory::class, function ($app) 
        {
            $config = isset($app['config']['infeed_gam']) ? $app['config']['infeed_gam'] : [];

            return new GAM($config);
            
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Factory::class];
    }
}
