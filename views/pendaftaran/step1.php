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
                <h2>Pendaftaran Anggota PASKIBRAKA Angkatan <?php echo date('Y'); ?></h2>
              </div>
            </div>
            <div class="panel-body">
              <form action="?url=pendaftaran/index&cmd=save" method="post" enctype="multipart/form-data">
                <!-- Form -->
                <div class="form">
                  <p>
                    <span class="req"></span>
                    <label>Email <span></span></label>
                    <input type="hidden" name="email" value="<?php echo $data['peserta']->getEmail(); ?>" />
                    <label><?php echo $data['peserta']->getEmail(); ?></label>
                  </p>
<!--                   <p>
  <span class="req"></span>
  <label>NRA <span></span></label>
  <input type="text" name="nra" class="field size1" value="<?php echo $data['peserta']->getNRA(); ?>" />
</p> -->
                  <p>
                    <span class="req"></span>
                    <label>Nama Panggilan <span></span></label>
                    <input type="text" name="namapanggilan" class="field size1" value="<?php echo $data['peserta']->getNamaPanggilan(); ?>" />
                  </p>
                  <p>
                    <span class="req"></span>
                    <label>Nama Lengkap <span>(Wajib diisi)</span></label>
                    <input type="text" name="namalengkap" class="field size1" value="<?php echo $data['peserta']->getNamaLengkap(); ?>" />
                  </p>
<!--                   <p>
                    <span class="req"></span>
                    <label>Angkatan <span>(Wajib diisi)</span></label>
                    <select name="angkatan" id="angkatan" class="field size1">
                    <?php $tahun = date('Y');for ($t = 0; $t <= 20; $t++) {?>
                      <option value=""><?php echo $tahun - $t; ?></option>
                    <?php }?>
                    </select>
                  </p> -->
                  <p>
                    <span class="req"></span>
                    <label>Jenis Kelamin <!-- <span>(Wajib diisi)</span> -->
                      <label for="laki">
                        &nbsp;&nbsp;&nbsp;<input type="radio" name="jeniskelamin" id="laki" value="L" <?=($data['jeniskelaminselect'] == 'L' || $data['jeniskelaminselect'] == '') ? 'checked="checked"' : '';?>> Laki - Laki
                      </label>
                      <label for="perempuan">
                        &nbsp;&nbsp;&nbsp;<input type="radio" name="jeniskelamin" id="perempuan" value="P" <?=($data['jeniskelaminselect'] == 'P') ? 'checked="checked"' : '';?>> Perempuan
                      </label>
                    </label>
                  </p>
                  <p>
                    <div class="form-group">
                      <label>Tempat Tgl Lahir</label>
                      <div class="col-sm-3">
                        <input type="text" name="tempatlahir" class="form-control" placeholder="Tempat" value="<?php echo $data['peserta']->getTempatLahir(); ?>" />
                      </div>
                      <div class="col-sm-3">
                        <input type="date" name="tgllahir" id="tgllahir" class="form-control" placeholder="Tanggal" value="" />
                      </div>
                    </div>
                  </p>
                  <p>
                    <span class="req">Minimal 6 angka</span>
                    <label>Telp/Handphone</label>
                    <input type="text" name="telp" class="field size1" value="<?php echo $data['peserta']->getNomerPonsel(); ?>" />
                  </p>
                  <p>
                    <span class="req"></span>
                    <label>Alamat Domisili</label>
                    <input type="text" name="alamatdomisili" class="field size1" value="" />
                    <select name="wilayah" class="field size1">
                    <?php foreach ($data['wilayah'] as $wilayah) {
    ?>
                      <option value="<?php echo $wilayah->id; ?>" <?=($data['wilayahselect'] == $wilayah->id) ? "selected='selected'" : '';?>><?php echo $wilayah->nama; ?></option>
                    <?php }?>
                    </select>
                  </p>
                  <p>
                    <span class="req"></span>
                    <label>Pendidikan Terakhir</label>
                    <select name="pendidikanterakhir" id="" class="size1">
                      <option value="SMP" <?=$data['pendidikanterakhirselect'] == 'SMP' ? 'selected' : '';?>>SMP</option>
                      <option value="SMU" <?=$data['pendidikanterakhirselect'] == 'SMU' ? 'selected' : '';?>>SMU</option>
                      <option value="SMK" <?=$data['pendidikanterakhirselect'] == 'SMK' ? 'selected' : '';?>>SMK</option>
                      <option value="D" <?=$data['pendidikanterakhirselect'] == 'D' ? 'selected' : '';?>>Diploma</option>
                      <option value="S1" <?=$data['pendidikanterakhirselect'] == 'S1' ? 'selected' : '';?>>Strata 1</option>
                      <option value="S2" <?=$data['pendidikanterakhirselect'] == 'S2' ? 'selected' : '';?>>Strata 2</option>
                      <option value="S3" <?=$data['pendidikanterakhirselect'] == 'S3' ? 'selected' : '';?>>Strata 3</option>
                    </select>
                  </p>
<!--                   <p>
                    <span class="req"></span>
                    <label>Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="field size1" value="<?php //echo $data['peserta']->getPekerjaan(); ;;?>" />
                  </p> -->
                  <p>
                    <span class="req"></span>
                    <label>Asal Sekolah</label>
                    <input type="text" name="institusi" class="field size1" value="<?php echo $data['peserta']->getInstitusi(); ?>" />
                  </p>
<!--                   <p>
                    <span class="req"></span>
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" class="field size1" value="<?php //echo $data['peserta']->getJabatan(); ;?>" />
                  </p> -->
                  <p>
                    <label>Foto </label>
                    <img src="<?php echo $data['peserta']->getFoto(); ?>" height="100px"/>
                    <input style="display: inline" type="file" name="foto" class="field" accept="image/jpg,image/jpeg,image/png" value="" />
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
    <script src="public/assets/js/jquery-ui.1.12.1.js"></script>
    <script>
      idx = 1;
<?php
$tgl = $data['peserta']->getTglLahir();
echo "d = '$tgl';";
?>
      $('#tgllahir').datepicker({
          changeYear: true,
          yearRange: '1945:+0',
          changeMonth:true,
          dateFormat:"yy-mm-dd"
      }).datepicker('setDate',d);
      $('#tambahdokumen').on('click',function(){
        idx++;
        var b = $('#daftardokumen span.dok').first().clone();
        b.find('label').html('Berkas '+idx);
        b.find('input').eq(0)
          .attr('name','judulfile['+idx+']')
          .attr('id','judulfile'+idx)
          .val('');
        b.find('input').eq(1)
          .attr('name','deskripsifile['+idx+']')
          .attr('id','deskripsifile'+idx)
          .val('');
        b.find('input').eq(2)
          .attr('name','berkas['+idx+']')
          .attr('id','berkas'+idx)
          .val('');
        b.appendTo('#daftardokumen');
        // $('#daftardokumen').append(b);
      });
    </script>
<?php echo $data['footer']; ?>
