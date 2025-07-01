<?php

namespace App\Providers;

use Laravel\Fortify\Contracts\LoginViewResponse;
use App\Http\Responses\LoginViewResponse as CustomLoginViewResponse;
use Laravel\Fortify\Contracts\RegisterViewResponse;
use App\Http\Responses\RegisterViewResponse as CustomRegisterViewResponse;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Illuminate\Http\RedirectResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \Laravel\Fortify\Contracts\LoginViewResponse::class,
            \App\Http\Responses\LoginViewResponse::class
        );

        $this->app->singleton(
            \Laravel\Fortify\Contracts\RegisterViewResponse::class,
            \App\Http\Responses\RegisterViewResponse::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        RateLimiter::for(
            'login',
            function (Request $request) {
                $email = (string) $request->email;

                return Limit::perMinute(10)->by($email . $request->ip());
            }

        );
        Fortify::loginView(function () {
            return view('auth.login');
        });


        Fortify::authenticateUsing(function (Request $request) {

            $user = \App\Models\User::where('email', $request->email)->first();

            if ($user && \Hash::check($request->password, $user->password)) {
                return $user;
            }
            return null;
        });
        $this->app->singleton(LoginResponse::class, function () {
            return new class implements LoginResponse {
                public function toResponse($request): RedirectResponse
                {
                    return redirect('/weight_logs');
                }
            };
        });
        $this->app->singleton(
            LogoutResponse::class,
            function () {
                return new class implements LogoutResponse {
                    public function toResponse($request): \Illuminate\Http\RedirectResponse
                    {
                        return redirect('/login');
                    }
                };
            }
        );
    }
}
