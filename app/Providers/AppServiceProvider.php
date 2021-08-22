<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        \App\Models\MovimentosEstoque::observe(\App\Observers\MovimentosEstoqueObserver::class);

        \App\Models\MovimentosFinanceiro::observe(\App\Observers\MovimentosFinanceiroObserver::class);

        Paginator::useBootstrap();
    }
}
