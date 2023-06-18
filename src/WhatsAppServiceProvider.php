<?php

namespace MainaDavid\WhatsAppSDK;

use Illuminate\Support\ServiceProvider;

class WhatsAppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register class in the service container
        $this->app->bind('whatsapp', function ($app) {
            return new WhatsApp();
        });
    }

    /**
     * It tells Laravel to publish the config file to the config folder
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/whatsapp.php' => config_path('whatsapp.php'),
        ], 'config');
    }
}