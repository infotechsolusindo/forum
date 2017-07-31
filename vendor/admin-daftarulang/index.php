<div class="panel panel-primary">
  <div class="panel-heading">
    <h2>Pendaftaran Ulang</h2>
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
      <?php foreach ($data->anggota as $p) {?>
        <tr>
          <td><?php echo $p->wilayah; ?></td>
          <td><?php echo $p->created; ?></td>
          <td><?php echo $p->namalengkap; ?></td>
          <td><?php echo $p->email; ?></td>
          <td>
          <a href="?url=admin/index/lihatanggota/<?php echo $p->email; ?>" class="btn btn-success btn-xs">Lihat</a>
          <a href="?url=admin/index/pendaftaran/daftarulang/<?php echo $p->email; ?>" class="btn btn-success btn-xs">Setujui</a>
          </td>
        </tr>
      <?php }?>
      </tbody>
    </table>
  </div>
</div>