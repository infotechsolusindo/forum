<?php echo $data['header']; ?>
    <!-- Container -->
    <div id="container">
      <div class="row">
      <center>
        <a href="?url=admin/index">Admin</a> |
        <a href="?url=admin/formulir">Formulir</a> |
        <a href="?url=admin/wilayah">Wilayah</a> |
        <a href="?url=admin/aturan">Aturan</a> |
        <a href="?url=admin/pendaftaran">Pendaftaran</a>
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
        <div class="col-md-2 col-sm-2">
          <?php echo $data['module_left']; ?>
        </div>
        <div id="main" class="col-md-8 col-sm-8">
          <label for="">Pendaftaran Baru</label>
          <table class="table">
            <thead>
            <tr>
              <th>Wilayah</th>
              <th>Tgl Daftar</th>
              <th>Nama Lengkap</th>
              <th>Email</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['pendaftaran'] as $pendaftaran) {?>
              <tr>
                <td><?php echo $pendaftaran->wilayah; ?></td>
                <td><?php echo $pendaftaran->tanggal; ?></td>
                <td><?php echo $pendaftaran->namalengkap; ?></td>
                <td><?php echo $pendaftaran->peserta; ?></td>
                <td><a href="?url=admin/index/pendaftaran/terima/<?php echo $pendaftaran->peserta; ?>" class="btn btn-success btn-xs">Seleksi</a></td>
              </tr>
            <?php }?>
            </tbody>
          </table>
        </div>
        <div class="col-md-2 col-sm-2">
          <?php echo $data['module_right']; ?>
        </div>
      </div>
    </div>
    <!-- End Container -->
<?php echo $data['footer']; ?>