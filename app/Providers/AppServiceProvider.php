<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Response::macro('attachment', function ($content, $fileName, $type) {

            $headers = [
                'Content-type'        => $type,
                'Content-Disposition' => 'attachment; filename="'. $fileName .'"',
            ];

            return \Response::make($content, 200, $headers);

        });
    }
}
