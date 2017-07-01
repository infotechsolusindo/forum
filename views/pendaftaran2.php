<?php echo $data['header']; ?>
    <!-- Container -->
    <div id="container">
      <?php if (!empty($data['successMessage'])) {?>
      <!-- Message OK -->
      <div id="successMessage" class="msg msg-ok">
        <p><strong><?php echo $data['successMessage']; ?></strong></p>
        <a href="#" class="close">close</a> </div>
      <!-- End Message OK -->
      <?php }?>
      <?php if (!empty($data['errorMessage'])) {?>
      <!-- Message Error -->
      <div id="errorMessage" class="msg msg-error">
        <p><strong><?php echo join($data['errorMessage'], '<br>'); ?></strong></p>
        <a href="#" class="close">close</a> </div>
      <!-- End Message Error -->
      <?php }?>
      <div class="row">
        <div id="main" class="col-md-10 col-sm-10">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="pull-left">
                <h2>Pendaftaran Anggota PASKIBRAKA</h2>
              </div>
              <form action="/">
              <div class="pull-right">
                <label><i class="glyphicon glyphicon-arrow-left"></i></label>
                <input type="submit" class="button" value="Kembali" />
              </div>
              </form>
            </div>
            <div class="panel-body">
              Pendaftaran Berhasil. Silahkan Login menggunakan email dan password yang sudah Anda daftarkan untuk melengkapi data pribadi.
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
