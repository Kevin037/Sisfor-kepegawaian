<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Divisi;
use App\Models\Fungsional;
use File;

use function Ramsey\Uuid\v1;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function data_profil()
    {
      $id = auth()->user()->id;
      $divisi = auth()->user()->divisi_id;
        $fungsional = auth()->user()->fungsional_id;

        $izin=Absensi::join('users', 'users.id','=','absensis.user_id')
        ->where('izin_id','!=',null)
        ->where('users.divisi_id',$divisi)
        ->where('users.fungsional_id','!=',$fungsional)
        ->where('absensis.approved_by','=',null)
        ->select('absensis.*','users.*', 'absensis.id as id_absensi')
        ->orderBy('absensis.created_at','asc')
        ->limit(6)
        ->get();

        $izin_saya=Absensi::where('user_id',$id)
        ->where('izin_id','!=',null)
        ->where('approved_by','!=',null)
        ->orWhere('rejected_by','!=',null)
        ->whereDate('updated_at','=',date('Y-m-d'))
        ->get();

        $jumlah_izin = count($izin);
        $jumlah_izin_saya = count($izin_saya);

        $user = User::where('id',$id)->get();
        return view('profil',compact('user', 'izin','izin_saya','fungsional', 'jumlah_izin', 'jumlah_izin_saya'));
    }

    public function edit_profil($id)
    {
        $user = User::where('id',$id)->get();
        $fungsional = Fungsional::pluck('nama_fungsional','id');
        $divisi = Divisi::pluck('nama_divisi','id');

        return view('form-edit-profil',compact('user','fungsional','divisi'));
    }

    public function lengkapi_profil($id)
    {
        $user = User::where('id',$id)->get();
        $fungsional = Fungsional::pluck('nama_fungsional','id');
        $divisi = Divisi::pluck('nama_divisi','id');

        return view('form-lengkapi-profil',compact('user','fungsional','divisi'));
    }

    public function update_lengkap_profil(Request $request, $id)
    {
            $user=User::find($id);
        $input = $request->all();
          $request->validate([
            'bill' => 'image|mimes:jpg,jpeg,png|max:900'
          ]);

          if ($user->foto != null) {
            File::delete('img/user/'.$user->foto);
          } 

        $image = $request->file('bill');
        $nama_gambar = $image->getClientOriginalName();
        $image->move('img/user/',$nama_gambar);
        $input['bill'] = $image->getClientOriginalName();

        $ubah_user=User::where('id',$id)
        ->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'foto' => $nama_gambar,
        ]);
        

        return redirect('/home')->with('toast_success', 'Profil berhasil anda lengkapi');
    }

    public function update_profil(Request $request, $id)
    {
        if ($request->bill) {
            $user=User::find($id);
        $input = $request->all();
          $request->validate([
            'bill' => 'image|mimes:jpg,jpeg,png|max:900'
          ]);

          if ($user->foto != null) {
            File::delete('img/user/'.$user->foto);
          } 

        $image = $request->file('bill');
        $nama_gambar = $image->getClientOriginalName();
        $image->move('img/user/',$nama_gambar);
        $input['bill'] = $image->getClientOriginalName();

        $ubah_user=User::where('id',$id)
        ->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'foto' => $nama_gambar,
        ]);
        } else {

        $ubah_user=User::where('id',$id)
        ->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);
        }
        

        return redirect('/profil')->with('toast_success', 'Profil berhasil diperbarui');
    }
}
