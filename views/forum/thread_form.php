<?php echo $data['header']; ?>
    <script src="public/assets/js/ckeditor/ckeditor.js"></script>
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
              <h2>Tambah Artikel</h2>
            </div>
            <div class="panel-body">
              <form action="?url=anggota/forum/simpan" method="post" enctype="multipart/form-data">
                <input type="hidden" name="tipe" value="1">
                <!-- Form -->
                <div class="form">
                  <p>
                    <span class="req">wajib diisi</span>
                    <label><span>Judul</span></label>
                    <input type="text" name="judul" value="" class="form-control" />
                  </p>
                  <p>
                    <span class="req"></span>
                    <label><span>Topik</span></label>
                    <input type="text" name="topikbaru" class="form-control" placeholder="Isi disini jika ingin membuat topik baru" value=""><br>
                    <select name="idtopik" id="" class="form-control">
                      <option value=""> -- Topik -- </option>
                      <option value="">Pemilu Presiden</option>
                      <option value="">Pemilu Presiden</option>
                    </select>
                  </p>
                  <p>
                    <span class="req">wajib diisi</span>
                    <label><span>Isi</span></label>
                    <textarea name="isi" id="isi" cols="30" rows="10" class="form-control" placeholder="Silahkan diisi dengan text">
                    </textarea>
                  </p>
                  <p>
                    <span class="req">max 100x100 pixel</span>
                    <label><span>Gambar</span></label>
                    <input type="file" name="gambar" value="" accept="image/*" />
                  </p>
                  <p>
                    <span class="req"></span>
                    <label><span>Tags</span></label>
                    <input type="text" name="tags" value="" class="form-control" />
                  </p>
                </div>
                <div class="text-center">
                  <a href="?url=anggota/forum" class="btn btn-success" style="text-decoration:none">Kembali</a>
                  <button type="submit" class="btn btn-success">Simpan</button>
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
    <script>
      if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
              CKEDITOR.tools.enableHtml5Elements( document );

      CKEDITOR.config.height = 250;
      CKEDITOR.config.width = 'auto';

      var initSample = ( function() {
        return function() {
          var editorElement = CKEDITOR.document.getById( 'isi' );
          CKEDITOR.replace( 'isi' );
        }
      })();

      initSample();
    </script>
    <!-- End Container -->
<?php echo $data['footer']; ?>