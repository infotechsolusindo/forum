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
        <div id="main" class="col-md-12 col-sm-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h2>Rekap Penilaian</h2>
            </div>
            <div class="panel-body">
              <div class="col-sm-12" style="overflow-x: scroll;">
              <form action="?url=juri/index/rekap&cmd=save" method="post">
                <input type="hidden" name="angkatan" value="<?=$data['angkatan'];?>">
                <input type="hidden" name="juri" value="<?=$data['juri'];?>">
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
                <?php
function eliminasi($nilai) {
    return $nilai == 0 ? 'eliminasi' : '';
}
?>
                <style>
                  .eliminasi {
                    background-color: black!important;
                  }
                </style>
                <?php foreach ($data['wilayah'] as $w) {
    ?>
                <?php if (array_key_exists($w->id, $data['rekapdata'])) {$rekap = ($data['rekapdata'][$w->id]);} else {continue;}?>
                <h3><b><?=$w->nama;?></b></h3>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px" rowspan="2">No.Peserta</th>
                      <th style="width: 200px;text-align: center" rowspan="2">Nama Peserta</th>
                      <?php foreach ($data['tahaps'] as $k => $v) {?>
                      <th colspan="2" style="text-align: center"><?=$k;?></th>
                      <?php }?>
                      <th colspan="2">Total</th>
                    </tr>
                    <tr>
                      <?php foreach ($data['tahaps'] as $k => $v) {?>
                      <th style="text-align: center">Jml</th>
                      <th style="text-align: center">Rata2</th>
                      <?php }?>
                      <th style="width: 10px">Nilai</th>
                      <th style="width: 10px">Rata2</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php

    foreach ($rekap as $r) {
        $nilai = 0;
        $rata = 0;
        ?>
                  <tr>
                    <td><?=$r['nopeserta'];?></td>
                    <td><?=$r['namapeserta'];?></td>
                    <?php foreach ($data['tahaps'] as $k => $v) {
            ?>
                    <td style="text-align: right" class="<?=eliminasi($r[$k]['jumlah']);?>"><?=$r[$k]['jumlah'];?></td>
                    <td style="text-align: right" class="<?=eliminasi($r[$k]['jumlah']);?>"><?=number_format($r[$k]['rata'], 2);?></td>
                    <?php
$nilai = $nilai + $r[$k]['jumlah'];
            $rata = $rata + $r[$k]['rata'];
            ?>
                    <?php }?>
                    <td><?=$nilai;?></td>
                    <td><?=number_format($rata, 2);?></td>
                  </tr>
                  <?php }?>
                  </tbody>
                </table>
                <?php }?>
              </form>
              </div>
            </div>
          </div>
        </div>
<!--         <div class="col-md-2 col-sm-2">
  <?php //echo $data['module_right']; ;?>
</div> -->
      </div>
    </div>
    <!-- End Container -->
<?php echo $data['footer']; ?>