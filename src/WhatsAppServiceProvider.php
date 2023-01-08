<?php

namespace MainaDavid\WhatsappSdk;

use Illuminate\Support\ServiceProvider;

class WhatsAppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register class in the service container
        $this->app->bind('whatsapp', function ($app) {
            return new WhatsApp();
        });
    }

    /**
     * It tells Laravel to publish the config file to the config folder
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/whatsapp.php' => config_path('whatsapp.php'),
        ], 'config');
    }
}