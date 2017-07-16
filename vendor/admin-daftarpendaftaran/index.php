<div class="panel panel-primary">
  <div class="panel-heading">
    <h2>Pendaftaran Baru</h2>
  </div>
  <div class="panel-body">
    <table class="table">
      <thead>
      <tr>
        <th>Wilayah</th>
        <th>Tgl Daftar</th>
        <th>Nama Lengkap</th>
        <th>Email</th>
        <th></th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($data->pendaftaran as $p) {?>
        <tr>
          <td><?php echo $p->wilayah; ?></td>
          <td><?php echo $p->tanggal; ?></td>
          <td><?php echo $p->namalengkap; ?></td>
          <td><?php echo $p->peserta; ?></td>
          <td>
          <a href="?url=admin/index/peserta/<?php echo $p->peserta; ?>" class="btn btn-success btn-xs">Lihat</a>
          <a href="?url=admin/index/pendaftaran/terima/<?php echo $p->peserta; ?>" class="btn btn-success btn-xs">Setujui</a>
          </td>
        </tr>
      <?php }?>
      </tbody>
    </table>
  </div>
</div>