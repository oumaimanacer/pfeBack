<?php

namespace App\Providers;

use Illum;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Factory;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Services\FirebaseAuthService;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->registerPolicies();

        $this->app->singleton(Auth::class, function ($app) {
            $firebaseCredentials = config('firebase.credentials');

            if (!file_exists($firebaseCredentials)) {
                throw new \Exception("Le fichier des credentials Firebase est introuvable : " . $firebaseCredentials);
            }

            return (new Factory)
                ->withServiceAccount($firebaseCredentials)
                ->createAuth();
        });
    }
}
