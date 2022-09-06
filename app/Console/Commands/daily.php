<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Absensi;

class daily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'day:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Penambahan data absensi harian';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl_skrg=Date('Y-m-d');
        $user = User::all();

        foreach ($user as $user2) { 
            $cek_tgl = Absensi::where('tgl',$tgl_skrg)->where('user_id',$user2->id)->count();
            if ($cek_tgl == 0) { 
                $absensi = Absensi::create([
                    'tgl' => $tgl_skrg,
                    'user_id' => $user2->id,
                    'status' => 'Tidak hadir',
                ]);   
            } 
        }
    }
}
