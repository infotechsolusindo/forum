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
              <form action="<?php echo SITE_ROOT; ?>">
              <div class="pull-right">
                <label><i class="glyphicon glyphicon-arrow-left"></i></label>
                <input type="submit" class="button" value="Kembali" />
              </div>
              </form>
            </div>
            <div class="panel-body">
              <form action="?url=index/pendaftaran1&cmd=save" method="post" enctype="multipart/form-data">
                <!-- Form -->
                <div class="form">
                  <p>
                    <span class="req"></span>
                    <label>Email <span>(Wajib diisi)</span></label>
                    <input type="text" name="email" class="field size1" value="<?php echo $data['akun']->getEmail(); ?>" />
                  </p>
                  <p>
                    <span class="req">Minimal 6 karakter alfanumerik</span>
                    <label>Password <span>(Wajib diisi)</span></label>
                    <input type="password" name="password" class="field size1" value="" />
                  </p>
                  <p>
                    <span class="req">Minimal 6 karakter alfanumerik</span>
                    <label>Konfirmasi Password <span>(Wajib diisi)</span></label>
                    <input type="password" name="konfirmasi" class="field size1" value="" />
                  </p>
                </div>
                <!-- End Form -->
                <!-- Form Buttons -->
                <div class="buttons">
                  <input type="submit" class="button" value="Simpan" />
                </div>
                <!-- End Form Buttons -->
              </form>
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
