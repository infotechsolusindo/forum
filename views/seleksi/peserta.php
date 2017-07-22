<?php echo $data['header']; ?>
    <!-- Container -->
    <div id="container">
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

          <div class="panel panel-primary">
            <div class="panel-heading">
              <h2>Informasi Peserta Seleksi</h2>
            </div>
            <div class="panel-body">
              <div class="col-sm-3">
                <div class="blank">&nbsp;</div>
                <center>
                <img src="<?php echo SITE_ROOT . '/public/data/foto/' . $data['peserta']->getFoto(); ?>" alt="" style="width: 100px">
                </center>
              </div>
              <div class="col-sm-9">
                <table class="table">
                  <tr>
                    <td>NRA</td><td>: <?php echo $data['peserta']->getnra(); ?></td>
                  </tr>
                  <tr>
                    <td>Email</td><td>: <?php echo $data['peserta']->getEmail(); ?></td>
                  </tr>
                  <tr>
                    <td>Nama Lengkap</td><td>: <?php echo $data['peserta']->getNamaLengkap(); ?></td>
                  </tr>
                  <tr>
                    <td>Jenis Kelamin</td><td>: <?=$data['peserta']->getJenisKelamin() == "L" ? "Laki-Laki" : "Perempuan";?></td>
                  </tr>
                  <tr>
                    <td>Tempat/Tgl Lahir</td><td>: <?php echo $data['peserta']->getTempatLahir() . ', ' . $data['peserta']->getTglLahir(); ?></td>
                  </tr>
                  <tr>
                    <td>Pendidikan</td><td>: <?php echo $data['peserta']->getPendidikanTerakhir(); ?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h2>Informasi Hasil Seleksi</h2>
            </div>
            <div class="panel-body">
              <div class="col-sm-12">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Tahapan Seleksi</th>
                      <th>Keterangan</th>
                      <th>Waktu Pelaksanaan</th>
                      <th>Hasil</th>
                      <th>Detail</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Administrasi</td>
                      <td>Wajib</td>
                      <td></td>
                      <td>A</td>
                      <td>
                        <a href="#" class="btn btn-success">Lihat</a>
                      </td>
                    </tr>
                    <tr>
                      <td>Tahap 1</td>
                      <td></td>
                      <td>Sabtu, 20 Juni 2017</td>
                      <td>B</td>
                      <td>
                        <a href="#" class="btn btn-success">Lihat</a>
                      </td>
                    </tr>
                    <tr>
                      <td>Tahap 2</td>
                      <td></td>
                      <td>Sabtu, 15 Juli 2017</td>
                      <td>A</td>
                      <td>
                        <a href="#" class="btn btn-success">Lihat</a>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Total</th>
                      <th></th>
                      <th></th>
                      <th>A</th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
            <?php echo $data['module_main']; ?>

        </div>
        <div class="col-md-2 col-sm-2">
          <?php echo $data['module_right']; ?>
        </div>
      </div>
    </div>
    <!-- End Container -->
<?php echo $data['footer']; ?>