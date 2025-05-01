<?php

namespace App\Providers;

use Kreait\Firebase\Factory;
use App\Services\FirebaseAuthService;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->singleton(FirebaseAuthService::class, function ($app) {
            //return new FirebaseAuthService();
        //});
        $this->app->singleton('firebase.firestore', function () {
            $factory = (new Factory)->withServiceAccount(
                storage_path('app/firebase_credentials.json')
            );
            return $factory->createFirestore()->database();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
