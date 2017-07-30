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
        <p><strong><?=$data['successMessage'];?></strong></p>
        <a href="#" class="close">close</a> </div>
      <!-- End Message OK -->
      <?php }?>
      <?php if ($data['errorMessage']) {?>
      <!-- Message Error -->
      <div id="errorMessage" class="msg msg-error">
        <p><strong><?=$data['errorMessage'];?></strong></p>
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
              <form action="?url=admin/index/setsession" method="post" class="form-horizontal">
                <div class="form-group">
                  <label for="" class="control-label col-md-3">
                    Set Session :
                  </label>
                  <div class="col-md-6">
                    <select name="angkatan" class="form-control">
                      <option value="2017" <?=($data['angkatan'] == 2017) ? 'selected' : '';?>)>2017</option>
                      <option value="2016" <?=($data['angkatan'] == 2016) ? 'selected' : '';?>)>2016</option>
                      <option value="2015" <?=($data['angkatan'] == 2015) ? 'selected' : '';?>)>2015</option>
                      <option value="2014" <?=($data['angkatan'] == 2014) ? 'selected' : '';?>)>2014</option>
                      <option value="2013" <?=($data['angkatan'] == 2013) ? 'selected' : '';?>)>2013</option>
                    </select>
                    <select name="tahap" class="form-control">
                      <option value="1" <?=($data['tahap'] == 1) ? 'selected' : '';?>)>1</option>
                      <option value="2" <?=($data['tahap'] == 2) ? 'selected' : '';?>>2</option>
                      <option value="3" <?=($data['tahap'] == 3) ? 'selected' : '';?>>3</option>
                      <option value="4" <?=($data['tahap'] == 4) ? 'selected' : '';?>>4</option>
                      <option value="5" <?=($data['tahap'] == 5) ? 'selected' : '';?>>5</option>
                      <option value="6" <?=($data['tahap'] == 6) ? 'selected' : '';?>>6</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </div>
              </form>
              <hr />
              <form action="?url=admin/index/generatePenilaian" method="post" class="form-horizontal">
                <div class="form-group">
                  <label for="" class="control-label col-md-3">Tahap</label>
                  <div class="col-md-6">
                    <select name="tahap" class="form-control">
                      <option value="1" <?=($data['tahap'] == 1) ? 'selected' : '';?>)>1</option>
                      <option value="2" <?=($data['tahap'] == 2) ? 'selected' : '';?>>2</option>
                      <option value="3" <?=($data['tahap'] == 3) ? 'selected' : '';?>>3</option>
                      <option value="4" <?=($data['tahap'] == 4) ? 'selected' : '';?>>4</option>
                      <option value="5" <?=($data['tahap'] == 5) ? 'selected' : '';?>>5</option>
                      <option value="6" <?=($data['tahap'] == 6) ? 'selected' : '';?>>6</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="control-label col-md-3">Kuota</label>
                  <div class="col-md-6">
                    <div class="input-group">
                    <input type="text" name="kuota" class="form-control">
                    <div class="input-group-addon">
                      <label for="" class="">peserta</label>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-9 col-md-offset-3">
                  <button type="submit" class="btn btn-primary">Generate Penilaian</button>
                  </div>
                </div>
              </form>
              <hr />
              <!--
              <form action="?url=admin/index/rekapPenilaian" method="post" class="form-horizontal">
                <div class="form-group">
                  <label for="" class="control-label col-md-3"> Rekap</label>
                  <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Rekap Penilaian</button>
                  </div>
                </div>
              </form>
              -->
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