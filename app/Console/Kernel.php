<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\QueueEmailCronTab',
        'App\Console\Commands\CoinMarketInsertWatchList',
        'App\Console\Commands\Review\UpdateReview',
        'App\Console\Commands\Order\HandleCreateOrder',
        'App\Console\Commands\Order\HandleCreateLoop',
        'App\Console\Commands\Order\UpdateOrder',
        'App\Console\Commands\Order\HandleCreateQuantity',
        'App\Console\Commands\Task\CallRefill',
        'App\Console\Commands\Order\ProcessingToCancelOrder',
        'App\Console\Commands\Order\HandleOrderManual',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('systems:handle-create-order-loop')->cron('*/1 * * * *');
        // $schedule->command('systems:handle-create-order-manual')->cron('*/1 * * * *');
        $schedule->command('systems:handle-create-order')->cron('*/1 * * * *');
        $schedule->command('systems:handle-create-order-quantity')->cron('*/1 * * * *');
        $schedule->command('systems:update-order')->cron('*/5 * * * *');
        $schedule->command('systems:call-refill')->dailyAt('03:00');
        $schedule->command('systems:processing-to-cancel')->cron('0 */4 * * *'); // every 4 hours
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}