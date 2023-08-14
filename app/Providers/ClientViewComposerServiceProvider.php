<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Client;

class ClientViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer('client.login', function ($view) {
            $subdomain = request()->getHost().':8000';
            $client = Client::where('url_platform', $subdomain)->first();
            $view->with('client', $client);
        });
        
    }
}
