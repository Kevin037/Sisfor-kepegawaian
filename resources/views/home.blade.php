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
        <li class="nav-item">
          <a href="/home" class="nav-link active">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/absensi" class="nav-link">
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
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $terlambat }}</h3>

                <p>Terlambat</p>
              </div>
              <div class="icon">
                <i class="ion ion-alert-circled"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $ontime }}</h3>

                <p>Tepat Waktu</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-alarm-clock"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{ $cuti }}</h3>

                <p>Cuti</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatbubble-working"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{ $sakit }}</h3>

                <p>Sakit</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-sad"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
         
          <!-- ./col -->
          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $jumlah_hadir }}</h3>

                <p>Total Kehadiran</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark-circled"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $jumlah_tidak_hadir }}</h3>

                <p>Total Tidak Hadir</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-remove-circle"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        
        <div class="card card-default">
          <div class="card-header">
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            
            <!-- /.row -->
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
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

