<div class="modal fade" id="form_izin_pegawai" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Informasi Perizinan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-md-7">
                    <div class="position-relative form-group">
                        <label>Nama :</label>
                        <div id="nama_izin"></div>
                      </div>
                    <div class="position-relative form-group">
                      <label>Tgl :</label>
                      &nbsp;<div id="tgl_izin"></div>
                    </div>
                  <div class="position-relative form-group"><label>Alasan :</label>
                    &nbsp;<div id="alasan_izin"></div>
                      </div>
                      <div class="position-relative form-group"><label>Keterangan :</label>
                        &nbsp;<div id="ket_izin"></div>
                      </div>
                </div>
                <div class="col-md-5" id="gambar_pegawai_izin">
                </div>
            </div>
            <hr>
            <input type="hidden" name="id_izin" id="id_izin" value="">
             <center><button type="button" class="btn btn-success approve_izin"><i class="fas fa-check"></i> Izinkan</button>&nbsp;&nbsp;<button class="btn btn-danger tolak_izin"><i class="fa fa-times"></i> Tolak</button></center>
        </div>
    </div>
</div>
</div>


<div class="modal fade" id="modal_detail_izin" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Informasi Perizinan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
          <div class="row">
              <div class="col-md-7">
                  <div class="position-relative form-group">
                    <label>Tgl :</label>
                    &nbsp;<div id="tgl_izin_r"></div>
                  </div>
                <div class="position-relative form-group"><label>Alasan :</label>
                  &nbsp;<div id="alasan_izin_r"></div>
                    </div>
                    <div class="position-relative form-group"><label>Keterangan :</label>
                      &nbsp;<div id="ket_izin_r"></div>
                    </div>
                    <div class="position-relative form-group"><label>Keputusan :</label>
                      &nbsp;<div id="keputusan"></div>
                    </div>
              </div>
              <div class="col-md-5" id="gambar_pegawai_izin_r">
              </div>
          </div>
          <hr>
        </div>
  </div>
</div>
</div>