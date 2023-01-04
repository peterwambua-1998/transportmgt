<?php

namespace App\Providers;

use App\DefaultMessageSetting;
use App\EmailSetting;
use App\PaymentGatewaySetting;
use App\Settings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use \Illuminate\Console\Scheduling\Schedule;

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
        $settings = Settings::find(1);

        $msgSettings = DefaultMessageSetting::find(1);

        $paySettings = PaymentGatewaySetting::find(1);

        $emailSettings = EmailSetting::find(1);

       

        View::share(['settings' => $settings, 'msgSettings' => $msgSettings, 'paySettings' => $paySettings, 'emailSettings' => $emailSettings]);
    }
}
