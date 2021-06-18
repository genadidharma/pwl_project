<?php

namespace App\Providers;

use App\Models\TransaksiObat;
use App\Models\TransaksiBarang;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Observers\TransaksiObatObserver;
use App\Observers\TransaksiBarangObserver;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
{
    TransaksiBarang::observe(TransaksiBarangObserver::class);
    TransaksiObat::observe(TransaksiObatObserver::class);
}
}
