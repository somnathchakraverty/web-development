<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $this->app['request']->server->set('HTTPS', $this->app->environment() == 'production');
        // If a send_ga_event session data is set, send it to the view
        view()->composer('*', function ($view) use ($request) {
            if(!app()->runningInConsole())
            {
                if ($request->session()->has('send_ga_event')) {
                    view()->share('send_ga_event', $request->session()->get('send_ga_event'));
                }
                if ($request->session()->has('errors')){
                    $errors     =   $request->session()->get('errors');
                    view()->share('session_error', $errors);
                }
            }
        });
        //
        $this->slackErrorLogging();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    
    
    public function slackErrorLogging()
    {
        
        $level = \Monolog\Logger::NOTICE;
        $channel = '#dev-log-errors';
        if (env('APP_ENV') == 'uat') {
            $channel = '#uat-log-errors';
        } else {
            if (env('APP_ENV') == 'production') {
                $channel = '#production-log-errors';
                $level = \Monolog\Logger::WARNING;
            } else {
                if (env('APP_ENV') == 'staging') {
                    $channel = '#staging-log-errors';
                } else if (env('APP_ENV') == 'local') {
                    $channel = '#web-errors-dev';
                }
            }
        }
        \Log::getMonolog()->pushHandler(new \Monolog\Handler\SlackHandler(env('SLACK_TOKEN'), $channel, 'Alert', true, null, $level,
        true, true, true));
    }
}
