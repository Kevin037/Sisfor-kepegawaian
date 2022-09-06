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
@foreach ($user as $user)
@if ($user->alamat==null || $user->no_telp == null || $user->foto == null)
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item active">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item active">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-pen-nib"></i>
            <p>
              Absensi
            </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book-open"></i>
            <p>
              Kehadiran
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item active">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Riwayat absensi
                </p>
              </a>
            </li>
            <li class="nav-item active">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Izin ketidakhadiran
                </p>
              </a>
            </li>
          </ul>
        </li>
        
        <li class="nav-item active">
          <a href="#" class="nav-link">
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
@endif
@if ($user->alamat!=null || $user->no_telp != null || $user->foto != null)
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
    <li class="nav-item active">
      <a href="/home" class="nav-link">
        <i class="nav-icon fas fa-pen-nib"></i>
        <p>
          Absensi
        </p>
      </a>
    </li>
    <li class="nav-item menu-open">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-book-open"></i>
        <p>
          Kehadiran
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item active">
          <a href="/home" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>
              Riwayat absensi
            </p>
          </a>
        </li>
        <li class="nav-item active">
          <a href="/home" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>
              Izin ketidakhadiran
            </p>
          </a>
        </li>
      </ul>
    </li>
    
    <li class="nav-item active">
      <a href="/home" class="nav-link">
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
@endif
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
                
                <div class="card bg-light d-flex flex-fill">
                  <div class="card-header text-muted border-bottom-0">
                    {{-- {{ $user->fungsional->nama_fungsional }} - {{ $user->divisi->nama_divisi }} --}}
                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-7">
                        <h2 class="lead"><b>{{ $user->nama }}</b></h2><br>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                          <li class="medium"><span class="fa-li"><i class="fas fa-lg fa-id-badge"></i></span> No pegawai: {{ $user->no_pegawai }}</li>
                          <li class="medium"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: {{ $user->email }}</li>
                          @if ( $user->alamat != null)
                          <li class="medium"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Alamat: {{ $user->alamat }}</li>
                          @else
                          <li class="medium"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Alamat: -</li>
                          @endif

                          @if ( $user->no_telp != null)
                          <li class="medium"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telp: {{ $user->no_telp }}</li>
                          @else
                          <li class="medium"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telp: -</li>
                          @endif
                        </ul>
                      </div>
                      <div class="col-5 text-center">
                        <img src="img/user/{{ $user->foto }}" alt="(upload gambar anda)" width="150px" class="img-circle img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-right">
                      @if ($user->alamat==null || $user->no_telp == null || $user->foto == null)
                      <a href="lengkapi-profil{{ $user->id }}" class="btn btn-sm btn-primary">
                      @endif
                      @if ($user->alamat!=null || $user->no_telp != null || $user->foto != null)
                      <a href="edit-profil{{ $user->id }}" class="btn btn-sm btn-primary">
                        @endif
                        <i class="fas fa-edit"></i> Ubah profil
                      </a>
                    </div>
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
  @endforeach
@endsection
@section('fot_dinamis')
</body>
</html>
@endsection

