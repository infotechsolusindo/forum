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
              <form action="?url=index/pendaftaran&cmd=save" method="post" enctype="multipart/form-data">
                <!-- Form -->
                <div class="form">
                  <p>
                    <span class="req"></span>
                    <label>Email <span>(Wajib diisi)</span></label>
                    <input type="text" name="email" class="field size1" value="<?php echo $data['capaska']->getEmail();?>" />
                  </p>
                  <p>
                    <span class="req">Minimal 6 karakter alfanumerik</span>
                    <label>Password <span>(Wajib diisi)</span></label>
                    <input type="password" name="password" class="field size1" value="" />
                  </p>
                  <p>
                    <span class="req">Minimal 6 karakter alfanumerik</span>
                    <label>Konfirmasi <span>(Wajib diisi)</span></label>
                    <input type="password" name="konfirmasi" class="field size1" value="" />
                  </p>
                </div>
                <div class="form">
                  <p>
                    <!-- <span class="req"></span> -->
                    <label>NRA <span></span></label>
                    <input type="text" name="nra" class="field size1" value="" />
                  </p>
                  <p>
                    <span class="req"></span>
                    <label>Nama Panggilan <span>(Wajib diisi)</span></label>
                    <input type="text" name="namapanggilan" class="field size1" value="" />
                  </p>
                  <p>
                    <span class="req"></span>
                    <label>Nama Lengkap <span>(Wajib diisi)</span></label>
                    <input type="text" name="namalengkap" class="field size1" value="" />
                  </p>
                  <p>
                    <span class="req"></span>
                    <label>Angkatan <span>(Wajib diisi)</span></label>
                    <select name="angkatan" id="angkatan" class="field size1">
                    <?php $tahun = date('Y'); for($t=0;$t<=20;$t++){?>
                      <option value=""><?php echo $tahun-$t;?></option>
                    <?php } ?>
                    </select>
                  </p>
                  <p>
                    <span class="req"></span>
                    <label>Jenis Kelamin <!-- <span>(Wajib diisi)</span> -->
                      <label for="laki">
                        &nbsp;&nbsp;&nbsp;<input type="radio" name="jeniskelamin" id="laki" value="L" checked="checked"> Laki - Laki
                      </label>
                      <label for="perempuan">
                        &nbsp;&nbsp;&nbsp;<input type="radio" name="jeniskelamin" id="perempuan" value="P"> Perempuan
                      </label>
                    </label>
                  </p>
                  <p>
                    <div class="form-group">
                      <label>Tempat Tgl Lahir</label>
                      <!-- <span class="req">Minimal 6 angka</span> -->
                      <div class="col-sm-3">
                        <input type="text" name="tempatlahir" class="form-control" value="" />
                      </div>
                      <div class="col-sm-3">
                        <input type="date" name="tgllahir" id="tgllahir" class="form-control" value="" />
                      </div>
                    </div>
                  </p>
                  <p>
                    <span class="req">Minimal 6 angka</span>
                    <label>Telp/Handphone</label>
                    <input type="text" name="telp" class="field size1" value="" />
                  </p>
                  <p>
                    <span class="req">Minimal 6 angka</span>
                    <label>Alamat Domisili</label>
                    <input type="text" name="alamatdomisili" class="field size1" value="" />
                  </p>
                  <p>
                    <span class="req">Minimal 6 angka</span>
                    <label>Pendidikan Terakhir</label>
                    <select name="pendidikanterakhir" id="" class="size1">
                      <option value="SMP">SMP</option>
                      <option value="SMU">SMU</option>
                      <option value="SMK">SMK</option>
                      <option value="D1">D1</option>
                      <option value="D3">D3</option>
                      <option value="S1">S1</option>
                    </select>
                  </p>
                  <p>
                    <span class="req">Minimal 6 angka</span>
                    <label>Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="field size1" value="" />
                  </p>
                  <p>
                    <span class="req">Minimal 6 angka</span>
                    <label>Institusi</label>
                    <input type="text" name="institusi" class="field size1" value="" />
                  </p>
                  <p>
                    <span class="req">Minimal 6 angka</span>
                    <label>Jabatan</label>
                    <select name="jabatan" id="" class="size1">
                      <option value="">---</option>
                      <option value="admin">Admin</option>
                      <option value="juri">Juri</option>
                    </select>
                  </p>
                  <p>
                    <label>Foto </label>
                    <input type="file" name="foto" class="field size1" accept="image/jpg,image/jpeg,image/png" value="" />
                  </p>
                  <p>
                    <div id="daftardokumen">                 
                      <span class="req">Tipe file (txt,docx,doc,pdf,xlsx,xls,semua image file)</span>
                      <label>Dokumen 
                        <button id="tambahdokumen" type="button"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
                        <a href="?url=index/daftarblanko">Daftar Berkas yang Harus Dilengkapi</a>
                      </label>
                      <span class="dok" style="display: block;background:lightgreen;" >
                        <label style="display:inline">Berkas 1</label>
                        <input type="text" name="judulfile[1]" placeholder="Judul">
                        <input type="text" name="deskripsifile[1]" placeholder="Deskripsi" style="width:400px">
                        <input id="berkas1" type="file" name="berkas[1]"  style="display:inline-block" class="" accept="text/plain,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,image/*" value=""/>
                      </span>
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
          <?php echo $data['module_right'];?>
        </div>
      </div>
    </div>
    <!-- End Container -->
    <script src="public/assets/js/jquery-ui.1.12.1.js"></script>
    <script>
      idx = 1;
      $('#tgllahir').datepicker({
          dateFormat:"yy-mm-dd"
      });
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
<?php echo $data['footer'];?>
