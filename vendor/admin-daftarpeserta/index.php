<div class="panel panel-primary">
  <div class="panel-heading">
    <h2>Daftar Peserta Seleksi</h2>
  </div>
  <button id="btntambah" class="btn btn-success">Tambah</button>
  <div class="panel-body">
    <table class="table">
      <thead>
      <tr>
        <th>Nama Lengkap</th>
        <th>Email</th>
        <th>Telp</th>
        <th>Status</th>
        <th></th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($data->pesertas as $p) {
    ?>
        <tr>
          <td><?php echo $p->getNamaLengkap(); ?></td>
          <td><?php echo $p->getEmail(); ?></td>
          <td><?php echo $p->getNomerPonsel(); ?></td>
          <td>
      <?php
switch ($p->getStatus()) {
    case 'A':
        echo "Aktif";
        break;
    case 'B':
        echo "Blocked";
        break;
    case 'C':
        echo "Dihapus";
        break;
    case 'D':
        echo "Non Aktif";
        break;
    default:
        echo "unknown";
        break;
    }?>
          </td>
          <td width="200px">
            <a href="?url=admin/index&mod=admindaftarpeserta/detail/<?php echo $p->getEmail(); ?>" class="btn btn-success btn-xs">Lihat</a>
            <a href="?url=admin/index&mod=admindaftarpeserta/block/<?php echo $p->getEmail(); ?>" class="btn btn-warning btn-xs">Block</a>
            <a href="?url=admin/index&mod=admindaftarpeserta/unblock/<?php echo $p->getEmail(); ?>" class="btn btn-success btn-xs">UnBlock</a>
            <a href="?url=admin/index&mod=admindaftarpeserta/hapus/<?php echo $p->getEmail(); ?>" class="btn btn-danger btn-xs">Hapus</a>
          </td>
        </tr>
      <?php }?>
      </tbody>
    </table>
  </div>
</div>
<div id="form">
  <table class="table" width="600px">
    <tr>
      <td>NRA</td><td><input type="text" name="nra"></td>
    </tr>
  </table>
</div>
<script src="/public/assets/js/jquery-ui.1.12.1.js"></script>
<script>
    $('#form').dialog({
      autoOpen: false,
      height: 400,
      width: 350,
      modal: true,
    });
    $('#btntambah').on('click',function(){
      $('#form').dialog('open');
    });
</script>