@extends('main')
@section('judul')
@if(auth()->user()->fungsional_id=='1') 
        <title>HRD - Home</title>
      @endif
@if(auth()->user()->fungsional_id=='2') 
        <title>Manajer - Home</title>
        @endif
@if(auth()->user()->fungsional_id=='3') 
        <title>Karyawan - Home</title>
@endif
@endsection
@section('sidebar')
<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item active">
      <a href="/home" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-pen-nib"></i>
        <p>
          Absensi
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-book-open"></i>
        <p>
          Kehadiran
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item active">
          <a href="/riwayat-absensi" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>
              Riwayat absensi
            </p>
          </a>
        </li>
        <li class="nav-item active">
          <a href="/riwayat-ketidakhadiran" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>
              Izin ketidakhadiran
            </p>
          </a>
        </li>
      </ul>
    </li>
    @if (auth()->user()->fungsional_id == 2)
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-book-open"></i>
          <p>
            Data Pegawai
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="/absensi-pegawai-today" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Absensi Hari ini
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/histori-absensi-pegawai" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Histori Absensi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/izin-pegawai" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Daftar Izin
              </p>
            </a>
          </li>
        </ul>
      </li>
      @endif
    
    <li class="nav-item active">
      <a href="/tatib" class="nav-link">
        <i class="nav-icon fas fa-clipboard-list"></i>
        <p>
          Tata tertib perusahaan
        </p>
      </a>
    </li>
  </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
@endsection


@section('isi')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @if(auth()->user()->role_id=='1') 
              <h1 class="m-0">Dashboard Admin</h1>
            @endif
            @if(auth()->user()->role_id=='2') 
              <h1 class="m-0">Dashboard User</h1>
            @endif
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            
            <div class="col-12 col-sm-6 col-md-12 d-flex align-items-stretch flex-column">
              <span><form method="post">
                <div class="form-group">
                    <center>
                        <label id="clock" style="font-size: 60px; color: #1a1a1a; -webkit-text-stroke: 3px #1a1a1a;
                                    text-shadow: 4px 4px 10px #d9d9d9,
                                    4px 4px 20px #d9d9d9,
                                    4px 4px 30px#d9d9d9,
                                    4px 4px 40px #d9d9d9;">
                        </label>
                    </center>
                </div>
            </form></span>
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Note:</h5>
                    Pastikan melakukan absensi sesuai pada jam ketentuan perusahaan.
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Absensi Harian</h3>
                
                          <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                              <div class="input-group-append">
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 200px;">
                          <table class="table table-head-fixed text-nowrap">
                            <thead>
                              <tr>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Absen masuk</th>
                                <th>Absen pulang</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($absensi as $absensi)
                              <tr>
                                {{-- Cek status kehadiran --}}
                                @if ($tgl_skrg == $absensi->tgl)
                                  @if ($sekarang <= $jam17)
                                    @if ($masuk == null)
                                      <td><p class="text-danger">Tidak hadir</p></td>
                                    @else
                                      <td><p class="text-success">Sedang bekerja</p></td>
                                    @endif
                                  @elseif($sekarang >= $jam17)
                                    @if ($absensi->status == 0)
                                      <td><p class="text-danger">Tidak hadir</p></td>
                                    @elseif($absensi->status == 1)
                                      <td><p class="text-success">Hadir</p></td>
                                    @endif
                                  @endif
                                @else
                                  @if ($absensi->status == 0)
                                    <td><p class="text-danger">Tidak hadir</p></td>
                                  @elseif($absensi->status == 1)
                                    <td><p class="text-success">Hadir</p></td>
                                  @endif
                                @endif
                                {{-- Cek status kehadiran --}}
                                <td>{{ $tgl_skrg }}</td>
                                @if ($absensi->masuk == null)
                                <td>-</td>
                                @else
                                <td>{{ $absensi->masuk }}</td>
                                @endif
                                @if ($absensi->keluar == null)
                                <td>-</td>
                                @else
                                <td>{{ $absensi->keluar }}</td>
                                @endif
                              </tr>
                              <tr><td colspan="4"><center><a href="/tambah-absensi" class="btn btn-lg btn-primary">
                                <i class="fas fa-check"></i> Absen sekarang
                              </a></center></td></tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
                
              </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
      
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('fot_dinamis')
</body>
</html>
@endsection

