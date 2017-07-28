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
              <h2>Pengelolaan Penilaian
              </h2>
            </div>
            <div id="panel-juri" class="panel-body">
              <form action="?url=admin/index/generatePenilaian" method="post" class="form">
                <div class="form-group">
                  <div class="group-item">
                  <label for="">Tahap
                    <select name="tahap">
                      <option value="1" <?=($data['tahap'] == 1) ? 'selected' : '';?>)>1</option>
                      <option value="2" <?=($data['tahap'] == 2) ? 'selected' : '';?>>2</option>
                      <option value="3" <?=($data['tahap'] == 3) ? 'selected' : '';?>>3</option>
                      <option value="4" <?=($data['tahap'] == 4) ? 'selected' : '';?>>4</option>
                      <option value="5" <?=($data['tahap'] == 5) ? 'selected' : '';?>>5</option>
                      <option value="6" <?=($data['tahap'] == 6) ? 'selected' : '';?>>6</option>
                    </select>
                  <label for="">Kuota
                  <input type="text" name="kuota">
                  </label>
                  </label>
                    <button type="submit" class="btn btn-primary">Generate Penilaian</button>
                  </div>
                </div>
              </form>
              <hr>
              <form action="?url=admin/index/rekapPenilaian" method="post" class="form form-inline">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Rekap Penilaian</button>
                </div>
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