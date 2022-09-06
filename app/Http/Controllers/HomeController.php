<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
Use Alert;
use App\Models\Absensi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = auth()->user()->id;
        $jam_masuk = Date('09:00');

        // JUMLAH DASHBOARD
        $jumlah_hadir=count(Absensi::where('user_id',$id)->where('status','1')->get());
        $izin_ditolak=count(Absensi::where('user_id',$id)->where('status','0')->whereNull('is_approve')->get());
        $alpha=count(Absensi::where('user_id',$id)->where('status','0')->where('is_approve','0')->get());
        $terlambat=count(Absensi::where('user_id',$id)->where('masuk','>',$jam_masuk)->where('status','1')->get());
        $ontime=count(Absensi::where('user_id',$id)->where('masuk','<=',$jam_masuk)->where('status','1')->get());
        $cuti=count(Absensi::where('user_id',$id)->where('izin_id','1')->where('is_approve','1')->get());
        $sakit=count(Absensi::where('user_id',$id)->where('izin_id','2')->where('is_approve','1')->get());
        $jumlah_tidak_hadir = $alpha + $izin_ditolak;
        // JUMLAH DASHBOARD

        // dd($jumlah_tidak_hadir);

        $user = User::where('id',$id)->get();

        foreach ($user as $user1 ) {
            $user_alamat =  $user1->alamat ;
            $user_no_telp =  $user1->no_telp ;
            $user_foto =  $user1->foto ;
        }

        if ($user_alamat == null || $user_no_telp == null || $user_foto == null ) {
            alert()->warning('Mohon Maaf','Harap lengkapi data diri anda terlebih dahulu');
            return view('profil',compact('user'));
        } 

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

        // dd($izin);

        return view('home',compact('izin','izin_saya','fungsional', 'jumlah_izin', 'jumlah_izin_saya',
        'jumlah_hadir','jumlah_tidak_hadir','terlambat','ontime','cuti','sakit'));
    }

    public function detail_izin($id){
        $izin_detail=Absensi::join('users', 'users.id','=','absensis.user_id')
        ->join('jenis_izins', 'jenis_izins.id','=','absensis.izin_id')
        ->where('absensis.id',$id)
        ->select('absensis.*','users.*','users.nama as nama_user', 'absensis.id as id_absensi', 'jenis_izins.*')
        ->get();

        return response()->json($izin_detail);
    }

    public function approve_izin($id){
        $id_approval = auth()->user()->id;

        $approve=Absensi::where('absensis.id',$id)
        ->update([
            'approved_by' => $id_approval,
            'is_approve' => 1
        ]);

        return back();
    }

    public function tolak_izin($id){
        $id_approval = auth()->user()->id;

        $approve=Absensi::where('absensis.id',$id)
        ->update([
            'approved_by' => $id_approval,
            'is_approve' => 0,
        ]);

        return back();
    }
}