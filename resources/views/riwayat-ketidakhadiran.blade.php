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
      <li class="nav-item menu-open">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-book-open"></i>
          <p>
            Kehadiran
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="/riwayat-absensi" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Riwayat absensi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/riwayat-ketidakhadiran" class="nav-link active">
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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Riwayat Izin</h1>
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
            
          <div class="col-12">
            <button type="button" class="btn btn-primary mb-3"  data-toggle="modal" data-target="#form_kategori">+ Ajukan Izin</button>
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover datatable">
                  
                  <thead>
                    <tr>
                      <th>Tgl</th>
                      <th>Alasan</th>
                      <th>Keterangan</th>
                      <th>Status</th>
                      <th>Disetujui oleh</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($absensi as $absensi)
                    <tr>
                      <td>{{ $absensi->tgl }}</td>
                      <td>@lang_u($absensi->izin->nama_izin)</td>
                      <td>{{ $absensi->keterangan }}</td>
                      @if ($absensi->approved_by == null)
                      <td>Menunggu approval</td>
                      @else
                      <td>Approved</td>
                      @endif
                      @if ($absensi->approved_by == null)
                      <td>-</td>
                      @else
                      <td>{{ $absensi->approved_by }}</td>
                      @endif
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
  <!-- /.content-wrapper -->
  <div class="modal fade" id="form_kategori" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah izin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
			<form action="/tambah-izin" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="form-group">
              <label>Date:</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                  {{-- <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/> --}}
                  <input type="date" class="form-control" id="tgl_izin" name="tgl_izin">
                    {{-- <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div> --}}
                </div>
            </div>
          <div class="position-relative form-group"><label>Alasan</label>
              <select class="form-control" name="alasan" required>
                  <option value="">-Pilih alasan-</option>
                  <option value="1">Cuti</option>
                  <option value="2">Sakit</option>
                </select>
              <div class="invalid-feedback">
                      Pilih alasan !
                  </div>
              </div>
              <div class="position-relative form-group"><label>Keterangan</label>
                <textarea name="keterangan" rows="4" cols="50"class="form-control"  required></textarea>
                  <div class="invalid-feedback">
                      Masukkan keterangan !
                  </div>
              </div>
             <center><button type="submit" class="btn btn-primary mb-3">Simpan</button></center>
			</form>
        </div>
    </div>
</div>
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

