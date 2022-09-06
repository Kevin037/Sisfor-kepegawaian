
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/sparklines/sparkline.js"></script>
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="js/adminlte.js"></script>
<script src="js/demo.js"></script>
<script src="js/pages/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.2/dist/sweetalert2.all.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script> --}}
<script src="plugins/moment/moment.min.js"></script>
{{-- <script src="plugins/daterangepicker/daterangepicker.js"></script> --}}
<script
src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js">
</script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="js/jam.js"></script>

@include('sweetalert::alert')
<script>
  (function() {
      'use strict';
      window.addEventListener('load', function() {
          var forms = document.getElementsByClassName('needs-validation');
          var validation = Array.prototype.filter.call(forms, function(form) {
              form.addEventListener('submit', function(event) {
                  if (form.checkValidity() === false) {
                      event.preventDefault();
                      event.stopPropagation();
                  }
                  form.classList.add('was-validated');
              }, false);
          });
      }, false);
  })();

</script>
<script type="text/javascript">
$(function () {
   $('#reservationdate').datetimepicker({
        format: 'L'
    });
  })
  </script>

<script>
  function btn_izin(id_absensi){
    event.preventDefault();
    jQuery.noConflict();     
            $.ajax({
                    url : "/detail-izin"+id_absensi,
                    dataType : 'json',
                    success: function(data){ 
                        var nama_izin = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data[0].nama_user;
                        var tgl_izin = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data[0].tgl;
                        var alasan_izin = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data[0].nama_izin;
                        var ket_izin = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data[0].keterangan;
                        var gambar_pegawai_izin = "<img src='img/user/"+data[0].foto+"' height='100%' width='100%' alt='User Avatar' class='mr-3 img-circle img-fluid'>";
                        if (data[0].is_approve == null) {
                          $('#gambar_pegawai_izin').html(gambar_pegawai_izin);
                          $('#nama_izin').html(nama_izin);
                          $('#tgl_izin').html(tgl_izin);
                          $('#alasan_izin').html(alasan_izin);
                          $('#ket_izin').html(ket_izin);
                          $('#id_izin').val(data[0].id_absensi);
                          window.$('#form_izin_pegawai').modal("show");
                        }else if(data[0].is_approve != null) {
                          $('#gambar_pegawai_izin_r').html(gambar_pegawai_izin);
                            if(data[0].is_approve == 1) {
                              var keputusan = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diizinkan";
                            }else if(data[0].is_approve == 0) {
                              var keputusan = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tidak diizinkan";
                            }
                          $('#keputusan').html(keputusan);
                          $('#tgl_izin_r').html(tgl_izin);
                          $('#alasan_izin_r').html(alasan_izin);
                          $('#ket_izin_r').html(ket_izin);
                          window.$('#modal_detail_izin').modal("show");
                        }
                    }
                });
		}
</script>
<script>
  $(".approve_izin").click(function(){
    var id_izin = $("#id_izin").val();
    // alert(id_izin); return false;
    Swal.fire({
    title: 'Yakin?',
    text: "Apakah anda ingin mengizinkan",
    // imageUrl: 'img/testing/katalog/+id_izin',
    imageWidth: 170,
    imageHeight: 230,
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, izinkan'
    }).then((result) => {
    if (result.isConfirmed) {
      window.location = "/approve-izin"+id_izin,
      Swal.fire(
        'Berhasil diizinkan!',
        'Selamat',
        'success'
      )
    }
    })
      });

      $(".tolak_izin").click(function(){
    var id_izin = $("#id_izin").val();
    // alert(id_izin); return false;
    Swal.fire({
    title: 'Yakin?',
    text: "Apakah anda ingin menolak",
    // imageUrl: 'img/testing/katalog/+id_izin',
    imageWidth: 170,
    imageHeight: 230,
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, tolak'
    }).then((result) => {
    if (result.isConfirmed) {
      window.location = "/tolak-izin"+id_izin,
      Swal.fire(
        'Izin Ditolak!',
        'Oh Kasihan',
        'error'
      )
    }
    })
      });

  $(".approve_izin").click(function(){
    var id_izin = $("#id_izin").val();
    // alert(id_izin); return false;
    Swal.fire({
    title: 'Yakin?',
    text: "Apakah anda ingin mengizinkan",
    // imageUrl: 'img/testing/katalog/+id_izin',
    imageWidth: 170,
    imageHeight: 230,
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, izinkan'
    }).then((result) => {
    if (result.isConfirmed) {
      window.location = "/approve-izin"+id_izin,
      Swal.fire(
        'Berhasil diizinkan!',
        'Selamat',
        'success'
      )
    }
    })
      });
</script>


