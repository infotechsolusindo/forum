<?php echo $data['header']; ?>
    <!-- Container -->
    <div id="container">
      <div class="">
      <?php echo $data['menujuri']; ?>
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
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h2>Rekap Penilaian</h2>
            </div>
            <div class="panel-body">
              <div class="col-sm-12" style="overflow-x: scroll;">
              <form action="?url=juri/index/rekap&cmd=save" method="post">
                <input type="hidden" name="angkatan" value="<?php echo $data['angkatan']; ?>">
                <input type="hidden" name="juri" value="<?php echo $data['juri']; ?>">
                <input type="hidden" name="tahap" value="<?=isset($data['tahap']) ? $data['tahap'] : '';?>">
                <table class="table">
                  <tr>
                    <td width="100px">Juri</td>
                    <td>: <?=$data['namajuri'];?></td>
                  </tr>
                  <tr>
                    <td>Angkatan</td>
                    <td>: <?=$data['angkatan'];?></td>
                  </tr>
                </table>
                <!-- <table id="form-rekap" class="table">
                  <thead>
                    <tr>
                      <th>No.Peserta</th>
                      <th>Nama</th>
                      <?php foreach ($data['datatahapan'] as $t) {?>
                      <th>Tahap<?=$t->tahap;?></th>
                      <?php }?>
                      <th>Hasil</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($data['pesertas'] as $peserta) {?>
                    <tr>
                      <td><?=$peserta->nra;?></td>
                      <td><?=$peserta->namalengkap;?></td>
                      <?php foreach ($data['datatahapan'] as $t) {?>
                      <?php if (isset($data['datarekap'][$peserta->nra][$t->tahap])) {?>
                      <td><?=$data['datarekap'][$peserta->nra][$t->tahap];?></td>
                      <?php } else {?>
                      <td></td>
                      <?php }?>
                      <?php }?>
                      <td></td>
                    </tr>
                  <?php }?>
                  </tbody>
                </table> -->
              </form>
              </div>
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