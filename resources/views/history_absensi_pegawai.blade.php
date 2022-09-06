@extends('main')
@section('judul')

@if(auth()->user()->role_id=='1') 
        <title>Admin - Data User</title>
      @endif
@if(auth()->user()->role_id=='2') 
        <title>User - Data User</title>
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
            <a href="#" class="nav-link">
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
      <li class="nav-item menu-open">
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
            <a href="/histori-absensi-pegawai" class="nav-link active">
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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Histori Absensi Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Histori Absensi Pegawai</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            
          <div class="col-12"> <!-- /.card -->
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover datatable">
                  
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Tgl</th>
                    <th colspan="2">Nama</th>
                    <th>Absen masuk</th>
                    <th>Absen keluar</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                    @foreach($absensi as $absensi)
                  <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $absensi->tgl }}</td>
                    <td><img src="img/user/{{ $absensi->user->foto }}" alt="User Avatar" class="img-size-50 mr-3 img-circle"></td>
                    <td>{{ $absensi->user->nama }}</td>
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
                    
                    {{-- Cek status kehadiran --}}
                    @if ($tgl_skrg == $absensi->tgl)
                      @if ($sekarang <= $jam17)
                        @if ($absensi->masuk == null)
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

                    @if ($absensi->izin_id == null)
                    <td>-</td>
                    @else
                    <td>{{ $absensi->izin->nama_izin }}</td>
                    @endif
                  </tr>
                  <?php $no++ ?>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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
  <!-- /.content-wrapper -->
@endsection
@section('fot_dinamis')

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
@endsection

