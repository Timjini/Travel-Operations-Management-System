<?php

namespace App\Providers;

use App\Services\Mailers\LaravelMailer;
use App\Services\Mailers\MailerInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MailerInterface::class, LaravelMailer::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \App\Models\Proforma::observe(\App\Observers\ProformaObserver::class);
        View::composer('*', function ($view) {
            $user = Auth::user();
            $company = $user && $user->company_id ? $user->company : null;
            $view->with('company', $company);
        });
        
        Livewire::setScriptRoute(function ($handle) {
        return Route::get('/crm/livewire/livewire.js', $handle);
    });

    // Fix the AJAX update endpoint
    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/crm/livewire/update', $handle);
    });
    }
}
