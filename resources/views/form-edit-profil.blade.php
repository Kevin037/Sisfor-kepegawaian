@extends('main')
@section('judul')
@if(auth()->user()->role_id=='1') 
        <title>Admin - Edit profil</title>
      @endif
@if(auth()->user()->role_id=='2') 
        <title>User - Edit profil</title>
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
      <li class="nav-item active">
        <a href="/absensi" class="nav-link">
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
            <a href="/riwayat-absensi" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Riwayat absensi
              </p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="/riwayat-izin" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Izin ketidakhadiran
              </p>
            </a>
          </li>
        </ul>
      </li>
      
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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perubahan Data Profil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Edit Profil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            
          <div class="col-12">
            <div class="card">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ubah Profil</h5>
                    </div>
                    <div class="modal-body">
                    @foreach ($user as $user)
                    
                    <form action="/update-profil{{ $user->id }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                    @csrf
                                                    <div class="position-relative form-group">
                                                      <label>Nama</label>
                                                      <input name="nama" type="text" value="{{ $user->nama }}" class="form-control"  required>
                                                    <div class="invalid-feedback">
                                                            Masukkan nama anda !
                                                        </div>
                                                    </div>
                                                    <div class="position-relative form-group">
                                                        <label>Email</label>
                                                        <input name="email" type="text" value="{{ $user->email }}" class="form-control"  required>
                                                    <div class="invalid-feedback">
                                                            Masukkan email !
                                                        </div>
                                                    </div>
                                                    <div class="position-relative form-group">
                                                        <label>Alamat</label>
                                                        <input name="alamat" type="text" value="{{ $user->alamat }}" class="form-control"  required>
                                                    <div class="invalid-feedback">
                                                            Masukkan alamat !
                                                        </div>
                                                    </div>
                                                    <div class="position-relative form-group">
                                                        <label>No telp</label>
                                                        <input name="no_telp" type="number" value="{{ $user->no_telp }}" class="form-control"  required>
                                                    <div class="invalid-feedback">
                                                            Masukkan no_telp !
                                                        </div>
                                                    </div>
                                                    <div class="position-relative form-group">
                                                        @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                          <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                          </ul>
                                                        </div>
                                                    @endif
                                                        <label>Gambar (max.900kb)</label>
                                                        <input type="file" class="form-control" name="bill" title="jpg,jpeg,png(max.900kb)" id="bukti_pembayaran" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                                        <div class="invalid-feedback">
                                                                Masukkan gambar produk !
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                          <div class="progress">
                                                              <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                                          </div>
                                                      </div>
                    
                        <center><button type="submit" class="btn btn-primary mb-3">Simpan</button></center>
                    </form>
                    @endforeach
                </div>
                </div>
              </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    
    <!-- /.content -->
  </div>
@endsection


@section('fot_dinamis')
</body>
</html>
@endsection

