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
              <ul>
                <li><a href="#">1. Biodata</a></li>
                <li><a href="#">2. Data Kesehatan</a></li>
                <li><a href="#">3. Surat Keterangan</a></li>
                <li>4. Ijazah</li>
                <li><a href="#">5. Data Orang/Tua Wali</a></li>
              </ul>
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
