<?php

namespace App\Console;

use App\Invoice;
use App\Mail\MonthlyInvoiceMail;
use App\Student;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function() {
            $students = Student::all();

            foreach ($students as $student) {
                $amt = $student->vehicle->route->price;
    
                $parent = $student->parent;
    
                $invoice = new Invoice();
                $invoice->parent_id = $parent->id;
                $invoice->student_id = $student->id;
                
                $invoice->inv_num = 'inv_' . rand();
                $invoice->amount = $amt;
                $invoice->status = 'unpaid';
                $invoice->save();
            
                Mail::to($parent->email)->send(new MonthlyInvoiceMail($invoice, $amt));
            }
        })->everyFiveMinutes();
        $schedule->command('queue:work --stop-when-empty')->everyMinute();
        
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
