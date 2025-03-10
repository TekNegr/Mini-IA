<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ChatBotService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ChatBotService::class, function ($app) {
            return new ChatBotService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
