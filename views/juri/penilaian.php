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
              <h2>Input Penilaian</h2>
            </div>
            <div class="panel-body">
              <div class="col-sm-12" style="overflow-x: scroll;">
              <form action="?url=juri/index/penilaian&cmd=save" method="post">
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
                  <tr>
                    <td>Tahap</td>
                    <td>: <?=$data['tahap'];?></td>
                  </tr>
                </table>
                <table id="form-penilaian" class="table">
                  <thead>
                    <tr>
                      <?php if (isset($data['headerpenilaian'])) {foreach ($data['headerpenilaian'] as $header) {?>
                      <th><?=$header;?></th>
                      <?php }}?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (isset($data['datapenilaian'])) {foreach ($data['datapenilaian'] as $penilaian) {?>
                    <tr>
                    <?php foreach ($penilaian as $k => $p) {?>
                      <?php if ($k == 'idwilayah') {continue;}?>
                      <?php if ($k == 'nmwilayah') {?>
                        <td style="white-space: nowrap;width: 50px"><?=$p;?></td>
                      <?php } else if ($k == 'id') {?>
                        <td style="white-space: nowrap;width: 10px"><?=$p;?></td>
                      <?php } else if ($k == 'nama') {?>
                        <td style=""><?=$p;?></td>
                      <?php } else if (!($k == 'id') || !($k == 'nama')) {?>
                      <?php if ($k == 'flag') {$flag = $k;} else {?>
                        <td style="width: 80px;">
                          <input type="text" style="width:100%"  autocomplete="off" maxlength="2" name="<?=$penilaian['id'] . '_' . $k;?>" value="<?php echo $p; ?>" <?php //$penilaian['flag'] == 1 ? 'disabled' : '';;;;?>>
                        </td>
                        <?php }?>
                      <?php }?>
                    <?php }?>
                    </tr>
                    <?php }}?>
                  </tbody>
                </table>
                <div>
                  <center>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </center>
                </div>
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
