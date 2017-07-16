<?php echo $data['header']; ?>
    <!-- Container -->
    <div id="container">
      <div class="row">
      <center>
        <a href="?url=admin/index">Admin</a> |
        <a href="?url=admin/index/formulir">Tahap Seleksi</a> |
        <a href="?url=admin/index/wilayah">Wilayah</a> |
        <a href="?url=admin/index/aturan">Aturan</a>
        </center>
      </div>
      <?php if ($data['successMessage']) {?>
      <!-- Message OK -->
      <div id="successMessage" class="msg msg-ok">
        <p><strong>Your file was uploaded succesifully!</strong></p>
        <a href="#" class="close">close</a> </div>
      <!-- End Message OK -->
      <?php }?>
      <?php if ($data['errorMessage']) {?>
      <!-- Message Error -->
      <div id="errorMessage" class="msg msg-error">
        <p><strong>You must select a file to upload first!</strong></p>
        <a href="#" class="close">close</a> </div>
      <!-- End Message Error -->
      <?php }?>
      <div class="row">
        <div class="col-md-10 hidden-xs">
          <?php echo $data['module_banner']; ?>
        </div>
        <div class="col-md-2">
          <?php echo $data['side_banner']; ?>
        </div>
      </div>
      <div class="row">
        <div id="main" class="col-md-10 col-sm-10">
          <?php echo $data['module_main']; ?>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h2>Detail Calon Peserta Seleksi</h2>
            </div>
            <div class="panel panel-body">
              <table class="table">
                <tr><td>Nama Lengkap</td><td>: <?php echo $data['namalengkap']; ?></td></tr>
                <tr><td>Email</td><td>: <?php echo $data['email']; ?></td></tr>
                <tr><td>Alamat Domisili</td><td>: <?php echo $data['alamatdomisili']; ?></td></tr>
                <tr><td>Tgl Lahir</td><td>: <?php echo $data['tgllahir']; ?></td></tr>
                <tr><td>Foto</td><td>: <img src="<?php echo $data['foto']; ?>" height="200" width="200"></td></tr>
                </tr>
              </table>
              <center>
                <a href="?url=admin/index" class="btn btn-success">Kembali</a>
              </center>
            </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h2>Daftar Berkas</h2>
            </div>
            <div class="panel panel-body">
              <table class="table">
              <?php foreach ($data['dokumens'] as $dokumen) {?>
                <tr>
                  <td><?php echo $dokumen->tipe; ?></td>
                  <td><?php echo $dokumen->judul; ?></td>
                  <td><?php echo $dokumen->namafile; ?></td>
                  <td>
                    <a href="<?php echo SITE_ROOT . '/public/data/berkas/' . basename($dokumen->file); ?>" class="btn btn-success">Download</a>
                  </td>
                </tr>
              <?php }?>
              </table>
              <center>
                <a href="?url=admin/index" class="btn btn-success">Kembali</a>
              </center>
            </div>
          </div>
        </div>
        <div class="col-md-2 col-sm-2">
          <?php echo $data['module_right']; ?>
        </div>
      </div>
    </div>
    <!-- End Container -->
<?php echo $data['footer']; ?>