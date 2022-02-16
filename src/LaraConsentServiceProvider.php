<?php

namespace Ekoukltd\LaraConsent;

use Ekoukltd\LaraConsent\Console\ActivatePendingConsents;
use Ekoukltd\LaraConsent\Http\Middleware\ForceRedirectToUnapprovedConsents;
use Ekoukltd\LaraConsent\Models\ConsentOption;
use Ekoukltd\LaraConsent\Models\ConsentOptionUser;
use Ekoukltd\LaraConsent\Providers\EventServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class LaraConsentServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laraconsent');
        $this->loadJsonTranslationsFrom(__DIR__.'/../resources/lang');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laraconsent');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->registerRoutes();
        $router = $this->app->make(Router::class);
        
        if(config('laraconsent.middleware.enable')){
            $router->pushMiddlewareToGroup('web', ForceRedirectToUnapprovedConsents::class);
        }

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
        
        //Create a ConsentOption user relation for each user class provided
        //eg.  ConsentOption->users() gets all users who have signed this consent.
        foreach(ConsentOption::getAllUserTypes() as $model)
        {
            $relationName = strtolower(Str::plural($model->name));
            
            ConsentOption::resolveRelationUsing($relationName, function ($consentOption) use ($model) {
                return $consentOption->morphedByMany(app($model->id), 'consentable')->using(ConsentOptionUser::class);
            });
        }
        
    }
    
    protected function registerRoutes()
    {
        Route::group($this->routeConfigurationAdmin(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        });
    
        Route::group($this->routeConfigurationUser(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/user.php');
        });
    }
    
    protected function routeConfigurationAdmin()
    {
        return [
            'prefix'     => config('laraconsent.routes.admin.prefix'),
            'middleware' => config('laraconsent.routes.admin.middleware'),
        ];
    }
    
    protected function routeConfigurationUser()
    {
        return [
            'prefix'     => config('laraconsent.routes.user.prefix'),
            'middleware' => config('laraconsent.routes.user.middleware'),
        ];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
                             __DIR__.'/../config/laraconsent.php' => config_path('laraconsent.php'),
                         ], 'laraconsent.config');
        
        // Publishing the views.
        $this->publishes([
                             __DIR__.'/../resources/views' => base_path('resources/views/vendor/ekoukltd/laraconsent'),
                         ], 'laraconsent.views');
    
        // Publishing Datatables.
        $this->publishes([
                             __DIR__.'/../resources/datatables/views' => base_path('resources/views/vendor/datatables'),
                         ], 'laraconsent.views');
    
        // Publishing CSS & JS assets.
        $this->publishes([
                             __DIR__.'/../resources/assets' => base_path('resources/assets/vendor/ekoukltd/laraconsent'),
                         ], 'laraconsent.assets');
    
        $this->publishes([
                             __DIR__.'/../resources/lang' => base_path('resources/lang/vendor/ekoukltd/laraconsent'),
                         ], 'laraconsent.assets');
        
        // Registering package commands.
        $this->commands([ActivatePendingConsents::class]);
    
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('laraconsent:activate-drafts')
                ->twiceDaily();
        });
    }
    
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laraconsent.php', 'laraconsent');
        
        // Register the service the package provides.
        $this->app->singleton('laraconsent', function ($app) {
            return new LaraConsent;
        });
    
        $this->app->register(EventServiceProvider::class);
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laraconsent'];
    }
}
