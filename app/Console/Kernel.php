<?php

namespace App\Console;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('day:update')->daily();

        $schedule->call(function () {

            date_default_timezone_set('Asia/Jakarta');
        $tgl_skrg=Date('Y-m-d');
        $user = User::all();

        foreach ($user as $user2) { 
            $cek_tgl = Absensi::where('tgl',$tgl_skrg)->where('user_id',$user2->id)->count();
            if ($cek_tgl == 0) { 
                $absensi = Absensi::create([
                    'tgl' => $tgl_skrg,
                    'user_id' => $user2->id,
                    'status' => '0',
                ]);   
            } 
        }

        })->daily();
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
