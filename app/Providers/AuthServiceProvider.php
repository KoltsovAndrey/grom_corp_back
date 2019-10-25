<?php

namespace App\Providers;

use App\Journal;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            if ($request->headers->get('token')) {
                $journal = Journal::where([['token', $request->headers->get('token')],['platform', $request->headers->get('platform')]])->first();
                // dd($journal->user_id);
                return User::where('id', $journal->user_id )->first();
            }
        });
    }
}
