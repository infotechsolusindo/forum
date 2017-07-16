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
              <h2>Panel Juri
              <button data-toggle="collapse" data-target="#panel-juri" class="badge pull-right">+</button>
              </h2>
            </div>
            <div id="panel-juri" class="panel-body">
              <form action="?url=juri/index/tampilkan" method="post" class="form form-inline">
                <div class="form-group">
                  <label for="">Wilayah</label>
                  <div class="group-item">
                    <select name="wilayah">
                      <?php foreach ($data['wilayah'] as $w) {?>
                      <option value="<?=$w->id;?>"><?=$w->nama;?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Tahap</label>
                  <div class="group-item">
                    <select name="tahap">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary pull-right">Generate Penilaian</button>
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