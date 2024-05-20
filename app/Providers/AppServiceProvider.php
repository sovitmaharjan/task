<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PDO;
use PDOException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('pdo', function () {
            try {
                switch (env('DB_HOST')) {
                    case 'sqlite':
                        return new PDO("sqlite:db.sqlite");
                    default:
                        return new PDO("mysql:host=" . env('DB_HOST') . ";dbname=" . env('DB_DATABASE'), env('DB_USERNAME'), env('DB_PASSWORD'));
                };
            } catch (PDOException $e) {
                die($e);
            }
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
