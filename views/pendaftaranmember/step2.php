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
              <form action="?url=pendaftaranmember/index&cmd=save2" method="post" enctype="multipart/form-data">
                <!-- Form -->
                <div class="form">
                  <p>
                    <div id="daftardokumen">
                      <span class="req">Tipe file (txt,docx,doc,pdf,xlsx,xls,semua image file)</span>
                      <label>Dokumen</label>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Berkas</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>File</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                    <?php foreach ($data['daftar'] as $daftar) {?>
                    <?php if (isset($data['dokumen'][$daftar->tipe])) {?>
                        <tr>
                          <td><?=$data['dokumen'][$daftar->tipe]->tipe;?></td>
                          <td><?=$data['dokumen'][$daftar->tipe]->judul;?></td>
                          <td><?=$data['dokumen'][$daftar->tipe]->deskripsi;?></td>
                          <td><?=$data['dokumen'][$daftar->tipe]->namafile;?></td>
                          <td><a href="?url=pendaftaranmember/index/dokumen/hapus/<?=$data['dokumen'][$daftar->tipe]->iddokumen;?>">hapus</a></td>
                        </tr>
                    <?php } else {?>

                        <tr>
                          <td><?php echo $daftar->tipe; ?></td>
                          <td>
                            <input type="hidden" name="judulfile[<?php echo $daftar->tipe; ?>]" value="<?php echo $daftar->judul; ?>">
                        <?php echo $daftar->judul; ?>
                          </td>
                          <td>
                            <input type="text" name="deskripsifile[<?php echo $daftar->tipe; ?>]" placeholder="Deskripsi" style="width:400px" value="<?=isset($data['dokumen'][$daftar->tipe]) ? $data['dokumen'][$daftar->tipe]->deskripsi : '';?>">
                          </td>
                          <td colspan="2">
                            <input id="berkas1" type="file" name="berkas[<?php echo $daftar->tipe; ?>]"  style="display:inline-block" class="" accept="text/plain,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,image/*"/>
                    <?php }?>
                          </td>
                        </tr>
                    <?php }?>
                        </tbody>
                      </table>
                    </div>
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
