<?php echo $data['header']; ?>
    <!-- Container -->
    <div id="container">
      <?php if (!empty($data['successMessage'])) {?>
      <!-- Message OK -->
      <div id="successMessage" class="msg msg-ok">
        <p><strong>Your file was uploaded succesifully!</strong></p>
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
                <h2>Pendaftaran Ulang Anggota PASKIBRAKA</h2>
              </div>
            </div>
            <div class="panel-body">
>           <p>Selamat datang kembali.</p>
            <p>
              Proses melengkapi data sudah selesai. Kami akan menghubungi kembali setelah data di validasi oleh Panitia.
            </p>
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
