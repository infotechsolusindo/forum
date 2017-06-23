<?php echo $data['header'];?>
    <!-- Container -->
    <div id="container">
      <?php if(!empty($data['successMessage'])){?>
      <!-- Message OK -->
      <div id="successMessage" class="msg msg-ok">
        <p><strong>Your file was uploaded succesifully!</strong></p>
        <a href="#" class="close">close</a> </div>
      <!-- End Message OK -->
      <?php } ?>
      <?php if(!empty($data['errorMessage'])){?>
      <!-- Message Error -->
      <div id="errorMessage" class="msg msg-error">
        <p><strong><?php echo join($data['errorMessage'],'<br>');?></strong></p>
        <a href="#" class="close">close</a> </div>
      <!-- End Message Error -->
      <?php } ?>
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
              <form action="?url=index/pendaftaran&cmd=save" method="post">
                <!-- Form -->
                <div class="form">
                  <p>
                    <span class="req"></span>
                    <label>Nama <span>(Wajib diisi)</span></label>
                    <input type="text" name="nama" class="field size1" value="" />
                  </p>
                  <p>
                    <span class="req"></span>
                    <label>Email <span>(Wajib diisi)</span></label>
                    <input type="text" name="email" class="field size1" value="" />
                  </p>
                  <p>
                    <span class="req">Minimal 6 angka</span>
                    <label>Telp</label>
                    <input type="text" name="telp" class="field size1" value="" />
                  </p>
                  <p>
                    <span class="req">Minimal 6 karakter alfanumerik</span>
                    <label>Password <span>(Wajib diisi)</span></label>
                    <input type="text" name="password" class="field size1" value="" />
                  </p>
                  <p>
                    <span class="req">Minimal 6 karakter alfanumerik</span>
                    <label>Konfirmasi <span>(Wajib diisi)</span></label>
                    <input type="text" name="konfirmasi" class="field size1" value="" />
                  </p>
                  <p>
                    <span class="req">Tipe file (txt,docx,doc,pdf,xlsx,xls,semua image file)</span>
                    <label>Dokumen <span>(Wajib diisi)</span></label>
                    <input type="file" name="file" class="field size1" accept="text/plain,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,image/*" value="" />
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
          <?php echo $data['module_right'];?>
        </div>
      </div>
    </div>
    <!-- End Container -->
<?php echo $data['footer'];?>