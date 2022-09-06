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
            <a href="/histori-absensi-pegawai" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Histori Absensi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/izin-pegawai" class="nav-link active">
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
            <h1>Daftar Izin Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Riwayat Izin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            
          <div class="col-12"><!-- /.card -->
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover datatable">
                  
                  <thead>
                    <tr>
                      <th>Tgl</th>
                      <th>Nama</th>
                      <th>Alasan</th>
                      <th>Status</th>
                      <th>Tindakan</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($absensi as $absensi)
                    <tr>
                      <td>{{ $absensi->tgl }}</td>
                      <td>{{ $absensi->user->nama }}</td>
                      <td>@lang_u($absensi->izin->nama_izin)</td>
                      @if ($absensi->is_approve == null)
                      <td>Menunggu approval</td>
                      @elseif($absensi->is_approve == 0)
                      <td>Ditolak</td>
                      @elseif($absensi->is_approve == 1)
                      <td>Diizinkan</td>
                      @endif
                      <td>
                        <button class="btn btn-primary" data-ap="{{ $absensi->id_absensi }}" onclick="btn_izin({{ $absensi->id_absensi }})"><i class="fas fa-search"></i>&nbsp;Detail</button></td>
                    </tr>
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
<script>
  $(function () {
 $('#reservationdate').datetimepicker({
        format: 'L'
    });
  })
</script>
</body>
</html>
@endsection

