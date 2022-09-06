<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function absensi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl_skrg=Date('Y-m-d');
        $id = auth()->user()->id;
        $absensi=Absensi::where('tgl',$tgl_skrg)->where('user_id',$id)->get();

        //  Cek status kehadiran
        foreach ($absensi as $absensik ) {
            $masuk =  $absensik->masuk ;
        }
        $sekarang=Date('H:i');
        $jam17 = Date('17:00');
         //  Cek status kehadiran

        $divisi = auth()->user()->divisi_id;
        $fungsional = auth()->user()->fungsional_id;

        $izin=Absensi::join('users', 'users.id','=','absensis.user_id')
        ->where('izin_id','!=',null)
        ->where('users.divisi_id',$divisi)
        ->where('users.fungsional_id','!=',$fungsional)
        ->where('absensis.is_approve','=',null)
        ->select('absensis.*','users.*', 'absensis.id as id_absensi')
        ->orderBy('absensis.created_at','asc')
        ->limit(6)
        ->get();

        $izin_saya=Absensi::join('users', 'users.id','=','absensis.user_id')
        ->where('absensis.user_id',$id)
        ->where('absensis.izin_id','!=',null)
        ->where('absensis.approved_by','!=',null)
        ->whereDate('absensis.updated_at','=',date('Y-m-d'))
        ->select('absensis.*','users.*', 'absensis.id as id_absensi')
        ->orderBy('absensis.created_at','asc')
        ->get();

        $jumlah_izin = count($izin);
        $jumlah_izin_saya = count($izin_saya);

        return view('absensi',compact('absensi','tgl_skrg', 'izin','izin_saya','fungsional', 'jumlah_izin', 'jumlah_izin_saya',
        'masuk', 'sekarang','jam17','tgl_skrg'));
        
    }

    public function riwayat_absensi()
    {
        $id = auth()->user()->id;

        //  Cek status kehadiran 
        $tgl_skrg=Date('Y-m-d');
        $absensi=Absensi::where('tgl',$tgl_skrg)->where('user_id',$id)->get();
        foreach ($absensi as $absensik ) {
            $masuk =  $absensik->masuk ;
        }
        $sekarang=Date('H:i');
        $jam17 = Date('17:00');
         //  Cek status kehadiran

        $absensi=Absensi::where('user_id',$id)
        ->orderBy('tgl','desc')
        ->get();

        $divisi = auth()->user()->divisi_id;
        $fungsional = auth()->user()->fungsional_id;

        $izin=Absensi::join('users', 'users.id','=','absensis.user_id')
        ->where('izin_id','!=',null)
        ->where('users.divisi_id',$divisi)
        ->where('users.fungsional_id','!=',$fungsional)
        ->where('absensis.is_approve','=',null)
        ->select('absensis.*','users.*', 'absensis.id as id_absensi')
        ->orderBy('absensis.created_at','asc')
        ->limit(6)
        ->get();

        $izin_saya=Absensi::join('users', 'users.id','=','absensis.user_id')
        ->where('absensis.user_id',$id)
        ->where('absensis.izin_id','!=',null)
        ->where('absensis.approved_by','!=',null)
        ->whereDate('absensis.updated_at','=',date('Y-m-d'))
        ->select('absensis.*','users.*', 'absensis.id as id_absensi')
        ->orderBy('absensis.created_at','asc')
        ->get();

        $jumlah_izin = count($izin);
        $jumlah_izin_saya = count($izin_saya);

        return view('riwayat-absensi',compact('absensi', 'izin','izin_saya','fungsional', 'jumlah_izin', 'jumlah_izin_saya',
            'masuk', 'sekarang','jam17','tgl_skrg'));
        
    }

    public function tambah_absensi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl_skrg=Date('Y-m-d');
        $absen=Date('H:i');
        // $absen='09p:01';
        $jam6 = Date('06:00');
        $jam9 = Date('09:00');
        $jam17 = Date('17:00');
        $jam24 = Date('23:59');

        $id = auth()->user()->id;
        $absensi=Absensi::where('tgl',$tgl_skrg)->where('user_id',$id)->get();
        foreach ($absensi as $absensik ) {
            $masuk =  $absensik->masuk ;
            $keluar =  $absensik->keluar ;
            $status =  $absensik->status ;
            $cuti =  $absensik->cuti ;
            $keterangan =  $absensik->keterangan ;
        }

        if ($absen >= $jam6  && $absen < $jam9) {

            if ($masuk == null) {
                $keterangan=Absensi::where('tgl',$tgl_skrg)->where('user_id',$id)
                ->update([
                    'masuk' => $absen,
                ]);
                return redirect('/absensi')->with('toast_success', 'Absen masuk berhasil');
            }else{
                return redirect('/absensi')->with('toast_error', 'Anda sudah melakukan absen');
            }
        }

        elseif ($absen >= $jam9 && $absen <= $jam17) {
            if ($masuk == null) {
                $keterangan=Absensi::where('tgl',$tgl_skrg)->where('user_id',$id)
                ->update([
                    'masuk' => $absen,
                ]);
                toast('Absen masuk berhasil, anda terlambat hadir','error');
                return redirect('/absensi');
            }else{
                return redirect('/absensi')->with('toast_error', 'Anda sudah melakukan absen');
            }
        }
        elseif ($absen > $jam17 && $absen <= $jam24) {
            if($masuk >= $jam6 && $masuk < $jam9)
            {
                $keterangan=Absensi::where('tgl',$tgl_skrg)->where('user_id',$id)
                ->update([
                    'keluar' => $absen,
                    'status' => '1',
                ]);

                toast('Absensi pulang berhasil, 
                anda ontime hari ini','success');
                return redirect('/absensi');
            }
            elseif($masuk >= $jam9 && $masuk <= $jam17)
            {
                $keterangan=Absensi::where('tgl',$tgl_skrg)->where('user_id',$id)
                ->update([
                    'keluar' => $absen,
                    'status' => '1',
                ]);

                toast('Absensi pulang berhasil, 
                anda terlambat hari ini','success');
                return redirect('/absensi');
            }elseif($masuk == null)
            {
                $keterangan=Absensi::where('tgl',$tgl_skrg)->where('user_id',$id)
                ->update([
                    'keluar' => $absen,
                ]);

                toast('Absensi tidak valid, 
                Anda tidak hadir hari ini','error');
                return redirect('/absensi');
            }
                
        }
        elseif ($absen > $jam24 && $absen < $jam6) {
            toast('Absensi tidak valid
            diluar jam operasional','error');
            return redirect('/absensi');
        }
    }

    public function riwayat_ketidakhadiran()
    {
        $id = auth()->user()->id;
        $divisi = auth()->user()->divisi_id;
        $fungsional = auth()->user()->fungsional_id;

        $izin=Absensi::join('users', 'users.id','=','absensis.user_id')
        ->where('izin_id','!=',null)
        ->where('users.divisi_id',$divisi)
        ->where('users.fungsional_id','!=',$fungsional)
        ->where('absensis.is_approve','=',null)
        ->select('absensis.*','users.*', 'absensis.id as id_absensi')
        ->orderBy('absensis.created_at','asc')
        ->limit(6)
        ->get();

        $izin_saya=Absensi::join('users', 'users.id','=','absensis.user_id')
        ->where('absensis.user_id',$id)
        ->where('absensis.izin_id','!=',null)
        ->where('absensis.approved_by','!=',null)
        ->whereDate('absensis.updated_at','=',date('Y-m-d'))
        ->select('absensis.*','users.*', 'absensis.id as id_absensi')
        ->orderBy('absensis.created_at','asc')
        ->get();

        $absensi=Absensi::where('user_id',$id)
        ->where('izin_id','!=','null')
        ->get();

        $jumlah_izin = count($izin);
        $jumlah_izin_saya = count($izin_saya);

        return view('riwayat-ketidakhadiran',compact('absensi','izin','izin_saya','fungsional', 'jumlah_izin', 'jumlah_izin_saya'));
        
    }
    
    public function tambah_izin(Request $request)
    {

        $tambah_izin = new Absensi();
        $tambah_izin->tgl = $request->tgl_izin;
        $tambah_izin->izin_id = $request->alasan;
        $tambah_izin->keterangan = $request->keterangan;
        $tambah_izin->status = "Tidak hadir";
        $tambah_izin->user_id = auth()->user()->id;
        $tambah_izin->save();

        toast('Pengajuan izin dikirim, 
                menunggu approval','success');
        return redirect('/riwayat-ketidakhadiran');
    }

    public function absensi_pegawai_today(){
        $id = auth()->user()->id;

        date_default_timezone_set('Asia/Jakarta');
        $tgl_skrg=Date('Y-m-d');

        $divisi = auth()->user()->divisi_id;
        $fungsional = auth()->user()->fungsional_id;

        $absensi=Absensi::join('users', 'users.id','=','absensis.user_id')
        ->where('users.divisi_id',$divisi)
        ->where('users.fungsional_id','!=',$fungsional)
        ->where('tgl',$tgl_skrg)
        ->get();

        $divisi = auth()->user()->divisi_id;
        $fungsional = auth()->user()->fungsional_id;

        $izin=Absensi::join('users', 'users.id','=','absensis.user_id')
        ->where('izin_id','!=',null)
        ->where('users.divisi_id',$divisi)
        ->where('users.fungsional_id','!=',$fungsional)
        ->where('absensis.is_approve','=',null)
        ->select('absensis.*','users.*', 'absensis.id as id_absensi')
        ->orderBy('absensis.created_at','asc')
        ->limit(6)
        ->get();

        $izin_saya=Absensi::join('users', 'users.id','=','absensis.user_id')
        ->where('absensis.user_id',$id)
        ->where('absensis.izin_id','!=',null)
        ->where('absensis.approved_by','!=',null)
        ->whereDate('absensis.updated_at','=',date('Y-m-d'))
        ->select('absensis.*','users.*', 'absensis.id as id_absensi')
        ->orderBy('absensis.created_at','asc')
        ->get();

        $jumlah_izin = count($izin);
        $jumlah_izin_saya = count($izin_saya);

        return view('absen_hari_ini',compact('absensi', 'izin','izin_saya','fungsional', 'jumlah_izin', 'jumlah_izin_saya',
        'sekarang','jam17'));
    }

    public function izin_pegawai(){

        $id = auth()->user()->id;
        date_default_timezone_set('Asia/Jakarta');
        $tgl_skrg=Date('Y-m-d');
        $divisi = auth()->user()->divisi_id;
        $fungsional = auth()->user()->fungsional_id;

        $absensi=Absensi::
        join('users', 'users.id','=','absensis.user_id')->
        join('jenis_izins', 'jenis_izins.id','=','absensis.izin_id')->
        where('users.divisi_id',$divisi)
        ->where('users.fungsional_id','!=',$fungsional)
        ->where('absensis.izin_id','!=',null)
        ->select('absensis.*','users.*','jenis_izins.*','absensis.id as id_absensi')
        ->get();

        $divisi = auth()->user()->divisi_id;
        $fungsional = auth()->user()->fungsional_id;

        $izin=Absensi::join('users', 'users.id','=','absensis.user_id')
        ->where('izin_id','!=',null)
        ->where('users.divisi_id',$divisi)
        ->where('users.fungsional_id','!=',$fungsional)
        ->where('absensis.is_approve','=',null)
        ->select('absensis.*','users.*', 'absensis.id as id_absensi')
        ->orderBy('absensis.created_at','asc')
        ->limit(6)
        ->get();

        $izin_saya=Absensi::join('users', 'users.id','=','absensis.user_id')
        ->where('absensis.user_id',$id)
        ->where('absensis.izin_id','!=',null)
        ->where('absensis.approved_by','!=',null)
        ->whereDate('absensis.updated_at','=',date('Y-m-d'))
        ->select('absensis.*','users.*', 'absensis.id as id_absensi')
        ->orderBy('absensis.created_at','asc')
        ->get();

        $jumlah_izin = count($izin);
        $jumlah_izin_saya = count($izin_saya);

        return view('izin_pegawai',compact('absensi', 'izin','izin_saya','fungsional', 'jumlah_izin', 'jumlah_izin_saya'));
    }

    public function histori_absensi_pegawai(){
        $id = auth()->user()->id;
        date_default_timezone_set('Asia/Jakarta');
        $tgl_skrg=Date('Y-m-d');
        $divisi = auth()->user()->divisi_id;
        $fungsional = auth()->user()->fungsional_id;

        //  Cek status kehadiran
        $sekarang=Date('H:i');
        $jam17 = Date('17:00');
         //  Cek status kehadiran

        $absensi=Absensi::join('users', 'users.id','=','absensis.user_id')
        ->where('users.divisi_id',$divisi)
        ->where('users.fungsional_id','!=',$fungsional)
        ->get();

        $divisi = auth()->user()->divisi_id;
        $fungsional = auth()->user()->fungsional_id;

        $izin=Absensi::join('users', 'users.id','=','absensis.user_id')
        ->where('izin_id','!=',null)
        ->where('users.divisi_id',$divisi)
        ->where('users.fungsional_id','!=',$fungsional)
        ->where('absensis.is_approve','=',null)
        ->select('absensis.*','users.*', 'absensis.id as id_absensi')
        ->orderBy('absensis.created_at','asc')
        ->limit(6)
        ->get();

        $izin_saya=Absensi::join('users', 'users.id','=','absensis.user_id')
        ->where('absensis.user_id',$id)
        ->where('absensis.izin_id','!=',null)
        ->where('absensis.approved_by','!=',null)
        ->whereDate('absensis.updated_at','=',date('Y-m-d'))
        ->select('absensis.*','users.*', 'absensis.id as id_absensi')
        ->orderBy('absensis.created_at','asc')
        ->get();

        $jumlah_izin = count($izin);
        $jumlah_izin_saya = count($izin_saya);

        return view('history_absensi_pegawai',compact('absensi', 'izin','izin_saya','fungsional', 'jumlah_izin', 'jumlah_izin_saya',
        'sekarang','jam17','tgl_skrg'));
    }
}
