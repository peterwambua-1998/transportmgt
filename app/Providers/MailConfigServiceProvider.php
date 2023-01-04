<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;


class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('email_settings')) {
            $mail = DB::table('email_settings')->first();

            if ($mail) {
                Config::set('mail.from.address', $mail->email);
                Config::set('mail.from.name', $mail->name);
            }
        }
    }
}
